define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'mage/storage'
    
    ],
    function(
         $,
        ko,
        Component,
        storage
    ) {
          'use strict';
        return Component.extend({
        
            myAjaxCall: function(dataToPass) {

                fullScreenLoader.startLoader();
                storage.post(
                    'ajaxcall/index/content',
                    JSON.stringify(dataToPass),
                    true
                ).done(
                    function (response) {
                       
                        alert('Success');
                        fullScreenLoader.stopLoader();
                    }
                ).fail(
                    function (response) {
                        alert('Fail');
                        fullScreenLoader.stopLoader();
                    }
                );
            }
        });
    }
);

