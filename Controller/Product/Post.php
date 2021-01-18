<?php
namespace Inchoo\ProductFAQ\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class Post extends Action
{

    public function execute()
    {
        var_dump($this->getRequest()->getParam('faq_question'));
        $product = (int)$this->getRequest()->getParam('id');
        var_dump($product);

    }
}
