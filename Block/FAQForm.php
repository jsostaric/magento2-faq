<?php
namespace Inchoo\ProductFAQ\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class FAQForm extends Template
{
    protected $_storeManager;

    public function __construct(Template\Context $context, StoreManagerInterface $storeManager, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
    }

    public function getAction()
    {
        return $this->getUrl(
            'productfaq/product/post',
            [
                'id' => $this->getProductId(),
                'storeId' => $this->getStoreId()
            ]
        );
    }

    protected function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    protected function getProductId()
    {
        return $this->getRequest()->getParam('id');
    }
}
