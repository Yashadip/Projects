<?php
namespace Allure\Account\Block\Order;

use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Sales\Model\Order\ItemFactory;
class Products extends \Magento\Framework\View\Element\Template
{

protected $resourceConnection;
protected $customerSession;
private $orderCollectionFactory;

public function __construct(
    Context $context,
    \Magento\Framework\App\ResourceConnection $resourceConnection,
    \Magento\Customer\Model\SessionFactory $customerSession,
    \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
    \Magento\Sales\Model\Order\ItemFactory $itemFactory
)
  {
      $this->resourceConnection = $resourceConnection;
      $this->customerSession = $customerSession;
      $this->orderCollectionFactory = $orderCollectionFactory;
      $this->itemFactory = $itemFactory;
      parent::__construct($context);
   }


    public function getOrder()
    {

        $connection = $this->resourceConnection->getConnection();
        $customerSession = $this->customerSession->create();

        if ($customerSession->isLoggedIn()) {
            $customerId  = $customerSession->getCustomer()->getId();

            $customerOrder = $this->orderCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId);


            foreach ($customerOrder as $value) {
                $custId = $value->getcustomerId();
             //   if ($custId <= 0) {
                    $EntityId = $value->getEntityId();


                    $order = $this->itemFactory->create()->getCollection()
                        ->addFieldToFilter('order_id', $EntityId)
                        ->addFieldToFilter('price', array('gt' => 0));


                    return $order->getData();

              //  }
            }

    }
  }
}