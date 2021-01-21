<?php

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faq;

use Inchoo\ProductFAQ\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action;

class Delete extends Action
{
    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(Action\Context $context, FaqRepositoryInterface $faqRepository)
    {
        parent::__construct($context);
        $this->faqRepository = $faqRepository;
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Inchoo_ProductFAQ::productfaq');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('faq_id');

        if ($id) {
            $question = $this->faqRepository->getById($id);
//            $question->delete();
        }

        return $this->_redirect('productfaq/faq/');
    }
}
