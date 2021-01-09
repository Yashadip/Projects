<?php

namespace Allure\Custom\Controller\Index;


use Magento\Framework\DataObjectFactory;
use Magento\Framework\Api\DataObjectHelper;

class Custom extends  \Magento\Framework\App\Action\Action
{
    protected $_customer;
    protected $_customerSession;
    protected $customerRepo;
    protected $customerFactory;
    protected $_modelCustomer;
    protected $_storeManager;

   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepo,
        \Magento\Customer\Model\Customer $modelCustomer,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_modelCustomer = $modelCustomer;
        $this->customerRepo = $customerRepo;
        $this->customerFactory = $customerFactory;
        $this->_customerSession = $customerSession;
        $this->_storeManager = $storeManager;

        parent::__construct(
            $context
        );
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($customerId = $this->getRequest()->getParam('customer_id')) {

                $customerRepo = $this->customerRepo->getById($customerId);

                $customer = $this->customerFactory->create()->load($customerId);
                
                $this->_customerSession->setCustomerAsLoggedIn($customer);

                $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
                
                $resultRedirect->setPath( $baseUrl  , ['id' => $customerId , '_current' => true]);

        return $resultRedirect;
  
  }

  }
  
}