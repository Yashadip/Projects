<?php

namespace Allure\User\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\ResourceModel\Group\Collection as StoreGroup;

Class CustomerGroups extends Template

 {
    public $storeGroup;
    public function __construct(
            StoreGroup $storeGroup
    ) {
        $this->storeGroup = $storeGroup;
    }
    
    public function getCustomerGroup() {
        $groups = $this->storeGroup->toOptionArray();
        return $groups;
    }    
}