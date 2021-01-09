<?php
namespace Allure\User\Plugin;

class LoginPlugin
{

    public function __construct(
    \Magento\Customer\Model\SessionFactory $customerSession 
    )
  {  
      $this->customerSession = $customerSession;
   }

    public function afterExecute(\Magento\Customer\Controller\Account\LoginPost $subject,$result)
    {
      
      $customerSession = $this->customerSession->create();

        if ($customerSession->isLoggedIn()){

           $groupId = $customerSession->getCustomerGroupId();

            if ($groupId == 4){

            $result->setPath('http://127.0.0.1/magento/');

            }
        }
        return $result;
    }
}