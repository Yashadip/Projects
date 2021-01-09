<?php

namespace Abandond\Cart\Cron;

class Reminder {

    public function __construct(
    \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Framework\Escaper $escaper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Quote\Model\QuoteFactory $quoteFactory, \Magento\Quote\Model\Quote\ItemFactory $ItemFactory) {

        $this->messageManager = $messageManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->storeManager = $storeManager;
        $this->quoteFactory = $quoteFactory;
        $this->ItemFactory = $ItemFactory;
    }

    public function execute() {

        $writer = new \Zend\Log\Writer\Stream(BP . "/var/log/Yashadip.log");
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $quote = $this->quoteFactory->create()->getCollection()
                ->addFieldToFilter('is_active', 1)
                ->addFieldToFilter('customer_email', array('neq' => ''))
                ->addFieldToFilter('items_qty', array('gt' => 0));

        foreach ($quote as $value) {

            $EntityId = $value->getEntityId();
            $CustomerFirstname = $value->getCustomerFirstname();
            $Subtotal = $value->getSubtotal();

            $quoteItem = $this->ItemFactory->create()->getCollection()
                    ->addFieldToFilter('quote_id', $EntityId)
                    ->addFieldToFilter('price', array('gt' => 0));


          $html = "<table><tr><th>SKU</th><th>Item</th><th>Price</th></tr>";
    

            foreach ($quoteItem as $item) {

                 $html .= "<tr style='border-bottom: 1px solid black;'>
                <td style='color:black;padding-top:15px;padding-bottom:15px;font-size: 12px;'>".$item->getSku()."</td>

                <td style='color:black;padding-top:15px;padding-bottom:15px;font-size: 12px;'>".$item->getName()."</td>

                <td style='color:black;padding-top:15px;padding-bottom:15px;font-size: 12px;'>$".$item->getPrice()."</td></tr>";
                            }

           $html .= "</table>";



            $this->inlineTranslation->suspend();
            $sender = [
                'name' => "Yash",
                'email' => 'code@allureinc.co',
            ];



            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->transportBuilder
                    ->setTemplateIdentifier('cart_reminder')
                    ->setTemplateOptions(
                            [
                                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                            ]
                    )
                    ->setTemplateVars([
                        'name' => $CustomerFirstname,
                        'proInfo'=>$html,
                        'subtotal'=>$Subtotal,
                    ])
                    ->setFrom($sender)
                    ->addTo($value['customer_email'], 'User')
                    ->getTransport();
            $transport->sendMessage();
        }

        return $this;
    }

}