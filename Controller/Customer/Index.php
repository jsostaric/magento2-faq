<?php

namespace Inchoo\ProductFAQ\Controller\Customer;

use Inchoo\ProductFAQ\Api\FaqRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;

class Index extends Action
{
    protected $faqRepository;
    protected $searchCriteriaBuilder;
    protected $customerSession;
    protected $faqRegistry;

    public function __construct(
        Context $context,
        FaqRepositoryInterface $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Session $customerSession,
        Registry $faqRegistry
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->faqRegistry = $faqRegistry;
    }

    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($navigationBlock = $resultPage->getLayout()->getBlock('customer_account_navigation')) {
            $navigationBlock->setActive('productfaq/customer');
        }
//        if ($block = $resultPage->getLayout()->getBlock('productfaq_customer_list')) {
//            $block->setRefererUrl($this->_redirect->getRefererUrl());
//        }

        //fetch questions associated with user
        $questions = $this->getQuestions('user_id', $this->getUserId());
        $this->faqRegistry->register('inchoo_product_faq', $questions);

        $resultPage->getConfig()->getTitle()->set(__('My Product Questions'));
        return $resultPage;
    }

    protected function getQuestions($field, $value)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter($field, $value)->create();

        return $this->faqRepository->getList($searchCriteria)->getItems();
    }

    protected function getUserId()
    {
        return (int)$this->customerSession->getId();
    }
}
