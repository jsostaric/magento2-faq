<?php
namespace Inchoo\ProductFAQ\Model;

use Inchoo\ProductFAQ\Api\Data;
use Inchoo\ProductFAQ\Api\FaqRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class FaqRepository implements FaqRepositoryInterface
{
    protected $faqModelFactory;
    protected $faqResource;
    protected $faqCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;

    public function __construct(
        \Inchoo\ProductFAQ\Api\Data\FaqInterfaceFactory $faqModelFactory,
        \Inchoo\ProductFAQ\Api\Data\FaqSearchResultsInterfaceFactory $searchResultsFactory,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faq $faqResource,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->faqModelFactory = $faqModelFactory;
        $this->faqResource = $faqResource;
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function getById(int $faqId)
    {
        $faq = $this->faqModelFactory->create();
        $this->faqResource->load($faq, $faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('Question does not exist!', $faqId));
        }

        return $faq;
    }

    public function save(Data\FaqInterface $faq)
    {
        try {
            $this->faqResource->save($faq);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return true;
    }

    public function delete(Data\FaqInterface $faq)
    {
        try {
            $this->faqResource->delete($faq);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Inchoo\ProductFAQ\Model\ResourceModel\Faq\Collection $collection */
        $collection = $this->faqCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var Data\FaqSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
