<?php
namespace Inchoo\ProductFAQ\Controller\Product;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Post extends Action
{
    protected $customerSession;

    public function __construct(Context $context, Session $customerSession)
    {
        parent::__construct($context);
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            $this->messageManager->addErrorMessage('You need to login before you submit your question');
            $this->_redirect($this->_redirect->getRefererUrl());
        }

        var_dump($this->getRequest()->getParam('faq_question'));
        $product = (int)$this->getRequest()->getParam('id');
        $isLoggedIn = $this->customerSession->isLoggedIn();
        var_dump($isLoggedIn);
    }
}
