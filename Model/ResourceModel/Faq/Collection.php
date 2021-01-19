<?php


namespace Inchoo\ProductFAQ\Model\ResourceModel\Faq;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Inchoo\ProductFAQ\Model\Faq::class,
            \Inchoo\ProductFAQ\Model\ResourceModel\Faq::class
        );
    }
}
