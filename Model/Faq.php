<?php
namespace Inchoo\ProductFAQ\Model;

use Inchoo\ProductFAQ\Api\Data\FaqInterface;

class Faq extends \Magento\Framework\Model\AbstractModel implements FaqInterface
{
    protected function _construct()
    {
        $this->_init(\Inchoo\ProductFAQ\Model\ResourceModel\Faq::class);
    }

    public function getId()
    {
        return $this->getData(self::FAQ_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::FAQ_ID, $id);
    }

    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }
}
