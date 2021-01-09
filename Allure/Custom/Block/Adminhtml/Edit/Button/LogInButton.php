<?php

namespace Allure\Custom\Block\Adminhtml\Edit\Button;

use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class LogInButton extends GenericButton implements ButtonProviderInterface 
{

    protected $_customerRepository;
   
    protected $customerAccountManagement;
    protected $_storeManager;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Api\AccountManagementInterface $customerAccountManagement,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager

    ) 
      {
        parent::__construct($context, $registry);
        $this->customerAccountManagement = $customerAccountManagement;
        $this->_customerRepository = $customerRepository;
        $this->_storeManager = $storeManager;
    }

    public function getButtonData()
  {
        $customerId = $this->getCustomerId();
        $data = [];
        if ($customerId) {
    
            $data = [
                'label' => __('Log In'),
                'on_click' => "window.open('{$this->getCustomUrl()}')",
                'sort_order' => 100,
            ];
        }
        return $data;
    }

    public function getCustomUrl()
    {

 $baseUrl = $this->_storeManager->getStore()->getBaseUrl();

        return $baseUrl.'custom/index/custom/customer_id/'.$this->getCustomerId();
    }
}
