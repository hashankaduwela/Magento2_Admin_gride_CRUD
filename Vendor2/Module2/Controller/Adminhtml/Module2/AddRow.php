<?php
/**
 * Vendor2 Module2 List Controller.
 * @category  Vendor2
 * @package   Vendor2_Module2
 * @author    Vendor2
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Vendor2\Module2\Controller\Adminhtml\Module2;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Vendor2\Module2\Model\Module2Factory
     */
    private $module2Factory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Vendor2\Module2\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Vendor2\Module2\Model\Module2Factory $module2Factory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->module2Factory = $module2Factory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->module2Factory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('module2/module2/rowdata');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ').$rowTitle : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vendor2_Module2::add_row');
    }
}
