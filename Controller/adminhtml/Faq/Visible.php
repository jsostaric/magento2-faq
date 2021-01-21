<?php

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faq;

use Inchoo\ProductFAQ\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\CouldNotSaveException;

class Visible extends Action
{
    public function __construct(Action\Context $context, FaqRepositoryInterface $faqRepository)
    {
        parent::__construct($context);
        $this->faqRepository = $faqRepository;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('faq_id');

        if ($id) {
            try {
                $toggleVisibilityOnPage = $this->faqRepository->getById($id);

                $visible = $toggleVisibilityOnPage->getIsListed();

                if (!$visible) {
                    $toggleVisibilityOnPage->setIsListed(1);
                } else {
                    $toggleVisibilityOnPage->setIsListed(0);
                }
                $toggleVisibilityOnPage->save();
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__('Can\'t make changes!'));
            }
        }

        return $this->_redirect('productfaq/faq/');
    }
}
