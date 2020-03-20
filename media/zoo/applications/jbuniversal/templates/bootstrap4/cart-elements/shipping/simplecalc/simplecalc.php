<?php
/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     http://jbzoo.com/license-pro.php JBZoo Licence
 * @coder       Denis Smetannikov <denis@jbzoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Class JBCartElementShippingSimpleCalc
 */
class JBCartElementShippingSimpleCalc extends JBCartElementShipping
{

    /**
     * @param array $params
     * @return bool
     */
    public function hasValue($params = array())
    {
        return true;
    }

    /**
     * @return JBCartValue
     */
    public function getRate()
    {
        if (method_exists($this, 'isFree') && $this->isFree()) {
            return $this->_order->val(0);
        }

        $rate   = $this->getPriceBase();
        $length = (int)$this->get('mkad_length');
        $mkadMax   = (int)$this->get('mkad_max');
        if ($length > $mkadMax) {
            $mkad = $this->getPriceForMkad()->multiply($length-$mkadMax);
            $rate->add($mkad);
        }
        //echo "<pre>";var_dump($mkadMax, $length);echo "</pre>";
        return $rate;
    }

    public function bindData($data = array())
    {
        /** @var AppData $data */
        $data = $this->app->data->create($data);

        $length = (int)$data->get('mkad_length', 0);
        $data->set('mkad_length', $length >= 0 ? $length : 0);

        $mkadMax = (int)$data->get('mkad_max', 20);
        $data->set('mkad_max', $mkadMax);

        return parent::bindData($data->getArrayCopy());
    }

    /**
     * @return array
     */



    public function getPriceForMkad()
    {
        return $this->_order->val($this->config->get('mkad_price', 300));
    }

    public function getPriceBase()
    {
        return $this->_order->val($this->config->get('base_price', 0));
    }
}
