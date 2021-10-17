<?php

/**
 * Grid Grid Collection.
 *
 * @category  Webkul
 * @package   Vendor2_Module2
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Vendor2\Module2\Model\ResourceModel\Module2;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Vendor2\Module2\Model\Module2',
            'Vendor2\Module2\Model\ResourceModel\Module2'
        );
    }
}
