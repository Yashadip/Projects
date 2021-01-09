<?php
namespace Allure\Rewards\Observer;

use Magento\Framework\Event\ObserverInterface;

class GetRewardOnShare implements ObserverInterface
{
     public function __construct(\Magento\Customer\Model\CustomerFactory $customerFactory, \Magento\Customer\Model\Session $customerSession,\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        $this->customerFactory = $customerFactory;
         $this->customerSession = $customerSession;
         $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {   
        $shareRewardPoint=2; 
    $rewardCollection = $this->orderCollectionFactory->create();
        $customer = $observer->getEvent()->getCustomer();
        $customer_id= $this->customerSession->getCustomer()->getId(); 

        foreach ($rewardCollection as $reward) {

            $rpCustomer = $reward->getCustomerId();
            $oldReward = $reward->getRewardPoints();

            if ($rpCustomer == $customer_id)
             {
             $total = $shareRewardPoint + $oldReward;
             $reward->setRewardPoints($total);
             $reward->save();
             exit();
            }
        }
    }
}