<?php

declare(strict_types=1);

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faq;

use Inchoo\ProductFAQ\Model\FaqRepository;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    /**
     * MassDelete constructor.
     * @param Action\Context $context
     * @param Filter $filter
     * @param FaqRepository $faqRepository
     */
    public function __construct(Action\Context $context, Filter $filter, FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $ids = $this->getRequest()->getParam('selected');

        if (!$ids) {
            $this->messageManager->addErrorMessage('Please select one or more rows');
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }

        try {
            $done = 0;
            foreach ($ids as $id) {
                $item = $this->faqRepository->getById((int)$id);
                $this->deleteItem($item);

                ++$done;
            }

            if ($done) {
                $this->messageManager->addSuccess(__('A total of %1 record(s) were modified.', $done));
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }

    /**
     * @param \Inchoo\ProductFAQ\Api\Data\FaqInterface $item
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    protected function deleteItem(\Inchoo\ProductFAQ\Api\Data\FaqInterface $item)
    {
        $this->faqRepository->delete($item);
    }
}
