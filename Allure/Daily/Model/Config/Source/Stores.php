<?php

namespace Allure\Daily\Model\Config\Source;

class Stores implements \Magento\Framework\Option\ArrayInterface
{
  
   public function toOptionArray()
   {

       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');

       $storeManagerDataList = $storeManager->getStores();
       $options = array();

        foreach ($storeManagerDataList as $key => $value)
        {
              $options[] = ['label' => $value['name'],  'value' => $key ];
        }
        return $options;
   }

}