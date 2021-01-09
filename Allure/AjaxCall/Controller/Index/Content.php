<?php

namespace Allure\AjaxCall\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\Controller\Result\JsonFactory;

class Content extends Action
{  
    protected $jsonHelper;

    protected $jsonFactory;

    public function __construct(
        Context $context,
        JsonHelper $jsonHelper,
        JsonFactory $jsonFactory
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $httpBadRequestCode = 400;
       
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return $this->jsonFactory->create()->setHttpResponseCode($httpBadRequestCode);
        }

        $html = $this->_view->getLayout()->createBlock(
            'Allure\AjaxCall\Block\Content'
        )->toHtml();
        
        $resultJson = $this->jsonFactory->create();
        return $resultJson->setData(['html' => $html]);
    }
}