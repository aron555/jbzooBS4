/**
 * JBZoo Application
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    Application
 * @license    GPL-2.0
 * @copyright  Copyright (C) JBZoo.com, All rights reserved.
 * @link       https://github.com/JBZoo/JBZoo
 */

;
(function ($, window, document, undefined) {

    /**
     *
     */
    JBZoo.widget('JBZoo.ShippingType.Courier', {}, {

        'change .jsHour, .jsFulldate, .jsWeekday': function (e, $this) {
            $this._updatePrice();
        }

    });

})(jQuery, window, document);