<?php

namespace Allure\Daily\Cron;

class CronFile {

    public function __construct(
    \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Framework\Escaper $escaper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Sales\Model\Order\ItemFactory $itemFactory,\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig) {

        $this->messageManager = $messageManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->storeManager = $storeManager;
        $this->itemFactory = $itemFactory;
        $this->scopeConfig = $scopeConfig;
    }

   public function execute() {

       $totalDiscount='0';
       $totalTax='0';
       $totalRefund='0';
       $totalShipping='0';
       $revenue='0';
       $grossRevenue='0';

       $info = $this->scopeConfig->getValue('allure/configurable_cron/recipient', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

       $storeView = $this->scopeConfig->getValue('allure/general/storeview', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

       $unit = $this->scopeConfig->getValue('general/locale/weight_unit',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
         );


       $value = $this->itemFactory->create()->getCollection()
                    ->addFieldToFilter('item_id', array('gt' => 0))
                    ->addFieldToFilter('price', array('gt' => 0));

          foreach ($value as $data) {


          $discount = $data->getDiscountAmount();
          $totalDiscount=$totalDiscount + $discount;

          $tax = $data->getTaxAmount();        
          $totalTax=$totalTax + $tax;

          $refund = $data->getDiscountRefunded();
          $totalRefund=$totalRefund + $refund;

          $ship = $data->getShippingAmount();
          $totalShipping=$totalShipping + $ship;

          $ship = $data->getShippingAmount();
          $totalShipping=$totalShipping + $ship;

          $gross = $data->getSubTotal();
          $revenue=$gross - $tax;
          $grossRevenue=$grossRevenue + $revenue;
        }

            $this->inlineTranslation->suspend();
            $sender = [
                'name' => "Yash",
                'email' => 'code@allureinc.co',
            ];

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->transportBuilder
                    ->setTemplateIdentifier('allure_configurable_cron_recipient')
                    ->setTemplateOptions(
                            [
                                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                            ]
                    )
                    ->setTemplateVars([ 'discount' => $totalDiscount,
                                        'tax' => $totalTax,
                                        'refund' => $totalRefund,
                                        'view' => $storeView,
                                        'unit' => $unit,
                                        'weight' => $totalWeight,
                                        'gross' => $grossRevenue,
                                        
                    ])
                    ->setFrom($sender)
                    ->addTo($info)
                    ->getTransport();
            $transport->sendMessage();
        

        return $this;
    }
}