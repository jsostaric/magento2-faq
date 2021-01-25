<?php

declare(strict_types=1);

namespace Inchoo\ProductFAQ\Ui\Component\Listing;

use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faq\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faq\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = $this->getCollection()->toArray();
        foreach ($data['items'] as &$item) {
            if (!$item['answer_content']) {
                $item['has_answer'] = 0;
            } else {
                $item['has_answer'] = 1;
            }
        }

        return $data;
    }
}
