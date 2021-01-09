<?php

namespace Allure\User\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;

Class SaveCustomerGroupId implements ObserverInterface 
{

    public $customerRepositoryInterface;
    public $messageManager;

    public function __construct(
            CustomerRepositoryInterface $customerRepositoryInterface,
            ManagerInterface $messageManager
    )
     {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->messageManager = $messageManager;
    }
    
    public function execute(\Magento\Framework\Event\Observer $observer) 
    {
       $accountController = $observer->getAccountController();
       $request = $accountController->getRequest();
       $group_id = $request->getParam('group_id');
       
       try 
       {

           $customerId = $observer->getCustomer()->getId();
           
           $customer = $this->customerRepositoryInterface->getById($customerId);

           $customer->setGroupId($group_id);

           $this->customerRepositoryInterface->save($customer);
           
       } catch (Exception $e){
           $this->messageManager->addErrorMessage(__('try again.'));
       }
    }
}