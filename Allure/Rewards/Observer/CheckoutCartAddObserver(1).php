<?php

namespace Allure\Rewards\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class CheckoutCartAddObserver implements ObserverInterface
{
	public function __construct(\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory , \Magento\Customer\Model\Session $customerSession
    ) {
         $this->orderCollectionFactory = $orderCollectionFactory;
          $this->customerSession = $customerSession;
      }

public function execute(\Magento\Framework\Event\Observer $observer)
  {
     //$writer = new \Zend\Log\Writer\Stream(BP.'/var/log/stackexchange.log');
            //$logger = new \Zend\Log\Logger();
            //$logger->addWriter($writer);

     $redeem = 1 ; //(5 reward points = 1$)
     $points = 5 ;

     $customer_id= $this->customerSession->getCustomer()->getId();
     $item = $observer->getEvent()->getQuoteItem();
     $item->getQuote()->collectTotals();

 
     $subtotal = $item->getQuote()->getSubtotal(); 
     $grandTotal = $item->getQuote()->getGrandTotal();  
     $rewardCollection = $this->orderCollectionFactory->create();

      foreach ($rewardCollection as $reward) {

        $rpCustomer = $reward->getCustomerId();      

        if ($rpCustomer == $customer_id )          
         {
             $rewardPoints = $reward->getRewardPoints();
            
             if ($rewardPoints >= 5) {
                   
             $rewardsubtotal = $subtotal - 1 ;
             $rewardgrandTotal = $grandTotal - 1;
             $item->getQuote()->setSubtotal($rewardsubtotal); 
             $item->getQuote()->setGrandTotal($rewardgrandTotal); 
             $item->save();
             $newReward = $rewardPoints - 5 ;
             $reward->setRewardPoints($newReward);
             $reward->save();
             exit();
         }
      }      
   }
}
}