<?php
namespace Inchoo\ProductFAQ\Block;

use Magento\Framework\View\Element\Template;

class FAQForm extends Template
{
    public function getAction()
    {
        return $this->getUrl(
            'productfaq/product/post',
            [
                'id' => $this->getProductId(),
            ]
        );
    }

    protected function getProductId()
    {
        return $this->getRequest()->getParam('id');
    }
}
