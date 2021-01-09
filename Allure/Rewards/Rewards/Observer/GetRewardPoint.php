<?php
namespace Allure\Rewards\Observer;

use Magento\Framework\Event\ObserverInterface;

class GetRewardPoint implements ObserverInterface
{
    private $checkoutSession;

     public function __construct(\Magento\Sales\Api\Data\OrderInterface $OrderInterface, \Magento\Catalog\Model\ProductRepository $ProductRepository,\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        $this->OrderInterface = $OrderInterface;
        $this->productRepository = $ProductRepository;
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {   
        $rewardPoint=5; 

        $custom = $observer->getEvent()->getOrder();

        $orderId = $custom->getId();
        $order =  $this->OrderInterface->load($orderId);
        $customer_id = $order->getCustomerId();

    $rewardCollection = $this->orderCollectionFactory->create();

        foreach ($rewardCollection as $reward) {
            $rpCustomer = $reward->getCustomerId();
            $oldrewards = $reward->getRewardPoints();
            if ($rpCustomer == $customer_id) {
                $reload = $rewardPoint + $oldrewards ;
                $reward->setRewardPoints($reload);
                $reward->save();
                exit();
                }
            }
        }
    }
