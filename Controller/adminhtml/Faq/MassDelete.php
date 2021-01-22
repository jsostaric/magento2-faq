<?php

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faq;

use Inchoo\ProductFAQ\Model\FaqRepository;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    public function __construct(Action\Context $context, Filter $filter, FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $ids = $this->getRequest()->getParam('selected');

            $done = 0;
            foreach ($ids as $id) {
                $item = $this->faqRepository->getById($id);
                $item->delete();

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
}
