<?php

namespace Inchoo\ProductFAQ\Block\Customer;

use Magento\Catalog\Model\ProductRepository;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Registry;

class ListCustomer extends \Magento\Customer\Block\Account\Dashboard
{
    protected $faqRegistry;
    protected $productRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        CustomerRepositoryInterface $customerRepository,
        AccountManagementInterface $customerAccountManagement,
        Registry $faqRegistry,
        ProductRepository $productRepository,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $customerSession,
            $subscriberFactory,
            $customerRepository,
            $customerAccountManagement,
            $data
        );
        $this->faqRegistry = $faqRegistry;
        $this->productRepository = $productRepository;
    }

    public function getQuestions()
    {
        return $this->faqRegistry->registry('inchoo_product_faq');
    }

    public function dateFormat($date)
    {
        return $this->formatDate($date, \IntlDateFormatter::SHORT);
    }

    public function getProductFaqUrl($question)
    {
        return $this->getUrl('productfaq/customer/view', ['id' => $question->getFaqId()]);
    }

    /**
     * Get product URL
     * @return string
     */
    public function getProductUrl($productId)
    {
        $product = $this->getProduct($productId);

        return $product->getProductUrl();
    }

    public function getProductName($productId)
    {
        $product = $this->getProduct($productId);
        return $product->getName();
    }

    protected function getProduct($productId)
    {
        return $this->productRepository->getById($productId);
    }
}
