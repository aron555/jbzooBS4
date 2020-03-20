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
class JBCartElementOrderText extends JBCartElementOrder
{
    /**
     * Renders the element in submission
     * @param array $params
     * @return string
     */
    public function renderSubmission($params = array())
    {
        $value = $this->getUserState($params->get('user_field'));

        $required = ($params->get('required') == '1') ? 'required' : '';

        $pattern = '';

        if (!empty($params->get('pattern'))) {
            $pattern = ' pattern="'.$params->get('pattern').'"';
        }

        return $this->app->html->_(
            'control.text',
            $this->getControlName('value'),
            $this->get('value', $value),
            'size="50" maxlength="255" class="form-control '.$params->get('class').'" '.$required.' '.$pattern.' placeholder="'.$params->get('placeholder').'" id="' . $this->htmlId() . '"'
        );
    }

}
