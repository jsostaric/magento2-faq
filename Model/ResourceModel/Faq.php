<?php
namespace Inchoo\ProductFAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('inchoo_product_faq', 'faq_id');
    }
}
