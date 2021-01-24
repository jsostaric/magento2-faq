<?php

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faq;

use Inchoo\ProductFAQ\Model\FaqRepository;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use phpDocumentor\Reflection\Types\This;

class MassVisible extends Action
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

        $ids = $this->getRequest()->getParam('selected');

        if(!$ids){
            $this->messageManager->addErrorMessage('Please select one or more rows');
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }

        try {
            $done = 0;
            foreach ($ids as $id) {
                $item = $this->faqRepository->getById($id);
                $visible = $item->getIsListed();
                if (!$visible) {
                    $item->setIsListed(1);
                } else {
                    $item->setIsListed(0);
                }
                $item->save();

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
