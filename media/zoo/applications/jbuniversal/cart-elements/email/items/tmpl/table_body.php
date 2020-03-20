<?php
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
 * @author     Denis Smetannikov <denis@jbzoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$config    = $this->config;
$items     = $order->getItems();
$itemsHtml = $order->renderItems(array(
    'image_width'  => $this->config->get('tmpl_image_width', 75),
    'image_height' => $this->config->get('tmpl_image_height', 75),
    'image_link'   => $this->config->get('tmpl_image_link', 1),
    'item_link'    => $this->config->get('tmpl_item_link', 1),
    'currency'     => $this->_getCurrency(),
    'email'        => true,
));

$i = 0;
?>

<?php
foreach ($itemsHtml as $itemKey => $itemHtml) :
    $i++;

    $rowattr = 'style="border-bottom: 1px solid #dddddd;"';
    if ($i % 2 == 1) {
        $rowattr .= ' bgcolor="#fafafa"';
    }

    ?>
    <tr <?php echo $rowattr; ?>>

        <td><?php echo $i;?></td>

        <td>
            <?php if ($config->get('tmpl_image_show', 1)) {
                echo $itemHtml['image'];
                $imageEmail = $itemHtml['imageEmail'];

                if ($imageEmail['path']) { // attach as content-id image
                    $this->_addEmailImage($imageEmail['path'], $imageEmail['cid']);
                }

            } ?>
        </td>

        <td style="width: 100%">
            <div class="item-table-name" style="padding: 10px">
                <?php echo $itemHtml['name']; ?>
                <?php echo $config->get('tmpl_sku_show', 1) ? $itemHtml['sku'] : null;?>
                <?php echo $itemHtml['params']; ?>
            </div>

            <table <?php echo $this->getAttrs(array(
                    'cellspacing' => 0,
                    'cellpadding' => 8,
                    'width'       => '100%',
                    'class'        => 'item-table-price'
                )) .
                $this->getStyles(array(
                    'border-collapse' => 'collapse'
                )); ?>
            >
                <tr style="border-bottom: 1px solid #dddddd;" bgcolor="#fafafa">

                    <?php if ($config->get('tmpl_price4one', 1)) { ?>
                        <td>
                            <?= JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_PRICE'); ?>
                        </td>
                    <?php } ?>


                    <?php if ($config->get('tmpl_quntity', 1)) { ?>
                        <td>
                            <?= JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_QUANTITY'); ?>
                        </td>
                    <?php } ?>


                    <?php if ($config->get('tmpl_subtotal', 1)) { ?>
                        <td>
                            <?= JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_ITEMTOTAL'); ?>
                        </td>
                    <?php } ?>

                </tr>
                <tr style="border-bottom: 1px solid #dddddd;" bgcolor="#fafafa">
                    <?php if ($config->get('tmpl_price4one', 1)) { ?>
                    <td>
                        <?= $config->get('tmpl_price4one', 1) ? $itemHtml['price4one'] : null;?>
                    </td>
                    <?php } ?>

                    <?php if ($config->get('tmpl_quntity', 1)) { ?>
                        <td>
                            <?php echo $config->get('tmpl_quntity', 1) ? $itemHtml['quantity'] : null;?>
                        </td>
                    <?php } ?>


                    <?php if ($config->get('tmpl_subtotal', 1)) { ?>
                        <td>
                            <?php echo $config->get('tmpl_subtotal', 1) ? $itemHtml['totalsum'] : null;?>
                        </td>
                    <?php } ?>

                </tr>
            </table>

        </td>

    </tr>
<?php endforeach; ?>
