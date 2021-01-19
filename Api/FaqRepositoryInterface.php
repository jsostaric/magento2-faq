<?php


namespace Inchoo\ProductFAQ\Api;


interface FaqRepositoryInterface
{
    /**
     * @param int $faqId
     * @return \Inchoo\ProductFAQ\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $faqId);

    /**
     * @param \Inchoo\ProductFAQ\Api\Data\FaqInterface $faq
     * @return \Inchoo\ProductFAQ\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\FaqInterface $faq);

    /**
     * @param \Inchoo\ProductFAQ\Api\Data\FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\FaqInterface $faq);

}
