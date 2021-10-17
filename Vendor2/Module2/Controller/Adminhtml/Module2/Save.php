<?php

/**
 * Module2 Admin Cagegory Map Record Save Controller.
 * @category  Webkul
 * @package   Vendor2_Module2
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Vendor2\Module2\Controller\Adminhtml\Module2;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Vendor2\Module2\Model\Module2Factory
     */
    var $module2Factory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Vendor2\Module2\Model\Module2Factory $module2Factory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Vendor2\Module2\Model\Module2Factory $module2Factory
    ) {
        parent::__construct($context);
        $this->module2Factory = $module2Factory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('module2/module2/addrow');
            return;
        }
        try {
            $rowData = $this->module2Factory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('module2/module2/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vendor2_Module2::save');
    }
}
