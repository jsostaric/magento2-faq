<?php


class FaqViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function __construct(
        \Inchoo\ProductFAQ\Api\FaqRepositoryInterface $faqRepository,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\Filter $filter
    )
    {
        $this->faqRepository = $faqRepository;
        $this->registry = $registry;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filter = $filter;
    }

}
