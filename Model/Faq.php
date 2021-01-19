<?php
namespace Inchoo\ProductFAQ\Model;

class Faq extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Inchoo\ProductFAQ\Model\ResourceModel\Faq::class);
    }
}
