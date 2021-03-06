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

/**
 * Class JBCartElementOrderFieldText
 */
class JBCartElementOrderTel extends JBCartElementOrder
{
    /**
     * Renders the element in submission
     * @param array $params
     * @return string
     */
    public function renderSubmission($params = array())
    {
        $value = $this->getUserState($params->get('user_field'));

        return $this->app->html->_(
            'control.text',
            $this->getControlName('value'),
            $this->get('value', $value),
            'size="50" maxlength="255" class="form-control telephone" placeholder="'.$params->get('placeholder').'" id="' . $this->htmlId() . '"'
        );
    }

}
