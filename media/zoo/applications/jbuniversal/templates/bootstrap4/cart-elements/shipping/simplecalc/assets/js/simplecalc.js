/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 *
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     http://jbzoo.com/license-pro.php JBZoo Licence
 * @coder       Denis Smetannikov <denis@jbzoo.com>
 */

;
(function ($, window, document, undefined) {

    JBZoo.widget('JBZoo.ShippingType.SimpleCalc', {}, {


        'change .jsMkadLength': function (e, $this) {
            var count = JBZoo.toInt($(this).val());
            $(this).val(count >= 0 ? count : 0);
            $this._delay(function () {
                $this._updatePrice();
            }, 300);
        }
    });

})(jQuery, window, document);
