<?php
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

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Class JBCartElementPaymentSberbank
 */

class JBCartElementPaymentSberbank extends JBCartElementPayment
{
	public function getRedirectUrl()
	{
		$method_step = $this->config->get('method_step');
		
		$order = $this->getOrder();
		$orderId = $this->getOrderId();
		$payCurrency = $this->getDefaultCurrency();
		$orderAmount = $this->_order->val($this->getOrderSumm(), $order->getCurrency())->convert($payCurrency);
		$orderAmount = $orderAmount->val() * 100;
		
		if (!session_id()) 
		{
			session_start();
		}
		if (!isset($_SESSION['SberbankOrderId']))
		{
			$_SESSION['SberbankOrderId'] = 0;
			$_SESSION['SberbankFormUrl'] = "";
		}
		if ($_SESSION['SberbankOrderId'] != $orderId)
		{
			$_SESSION['SberbankOrderId'] = $orderId;
			$fields = array
			(
				'userName' => \Joomla\String\StringHelper::trim($this->config->get('merchant')),
				'password' => \Joomla\String\StringHelper::trim($this->config->get('password')),
				'amount' => $orderAmount,
				'orderNumber' => $orderId, //$this->getOrderId(),
				'returnUrl' => $this->_jbrouter->payment('success'), //'http://мойсайт/index.php?option=com_zoo&controller=payment&task=paymentSuccess',
				'failUrl' => $this->_jbrouter->payment('fail') //'http://мойсайт/index.php?option=com_zoo&controller=payment&task=paymentFail'
			);
			
			if($this->isDebug())
			{
				$action_adr = $this->config->get('API_URL_TEST');
			}
			else
			{
				$action_adr = $this->config->get('API_URL_PROD');
			}
			
			if ($method_step == '1')
			{
				$action_adr .= 'register.do';
			}
			else 
			{
				$action_adr .= 'registerPreAuth.do';
			}
		
			$rbsCurl = curl_init();
			curl_setopt_array($rbsCurl, array(
			CURLOPT_URL => $action_adr,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($fields)
			));
			
	
			$response = curl_exec($rbsCurl);
			curl_close($rbsCurl);
			$this->logInfo("--------------------------------------------");
			$this->logInfo("Запрос на мерчант: " . $action_adr . " | Параметры: " . http_build_query($fields) . " | Ответ: " . $response);
			
			$response = json_decode($response, true);
			$errorCode = $response['errorCode'];
			if ($errorCode > 0)
			{
				echo 'ошибка #'.$errorCode.': '.$response['errorMessage'];
			}
			$_SESSION['SberbankFormUrl'] = $response['formUrl'];
			return $response['formUrl'];
			
		}
		else
		{
			return $_SESSION['SberbankFormUrl'];
		}
	}
	
	public function isValid($params = array())
	{
		if (isset($_REQUEST['orderStatus']))
		{
			if ($_REQUEST['orderStatus'] == '1' || $_REQUEST['orderStatus'] == '2') 
			{
				if (isset($_REQUEST['checkOrderId']))
				{
					//Повторно проверяем платеж после callback
					$method_step = $this->config->get('method_step');
					
					$fields = array(
					'userName' => $this->config->get('merchant'),
					'password' => $this->config->get('password'),
					'orderId' => $_REQUEST['checkOrderId']
					);
				
					if ($this->isDebug())
					{
						$action_adr = $this->config->get('API_URL_TEST');
					}
					else
					{
						$action_adr = $this->config->get('API_URL_PROD');
					}
					$action_adr .= 'getOrderStatus.do';
				
					$rbsCurlRecheck = curl_init();
					curl_setopt_array($rbsCurlRecheck, array(
					CURLOPT_URL => $action_adr,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => http_build_query($fields)
					));
					
					$response = curl_exec($rbsCurlRecheck);
					curl_close($rbsCurlRecheck);
					
					$this->logInfo("Запрос повторной проверки состояния платежа: " . $action_adr . " | Параметры: " . http_build_query($fields) . " | Ответ: " . $response);
					
					$response = json_decode($response, true);
					$orderStatus = $response['OrderStatus'];
					$orderNumber = $response['OrderNumber'];
					
					$order = $this->getOrder();
					$orderId = $this->getOrderId();
					if ((int)$orderNumber == (int)$orderId)
					{
						if ($orderStatus == '1' || $orderStatus == '2')
						{
							$this->logInfo("Платеж успешно завершен!");
						        return true;
						}
						else
						{
							$this->logInfo("Платеж прошел с ошибкой! orderStatus не равен 1 или 2.");
						        return false;
						}
					}
					else
					{
						$this->logInfo("Платеж прошел с ошибкой! orderNumber и orderId не совпадают.");
					        return false;
					}
				}
				else
				{
					$this->logInfo("Платеж прошёл с ошибкой! Не задан checkOrderId.");
				        return false;
				}
			}
			else
			{
				$this->logInfo("Платеж прошёл с ошибкой! orderStatus не равен 1 или 2.");
			        return false;
			}
		}
		else
		{
			$this->logInfo("Платеж прошёл с ошибкой! Не задан orderStatus.");
		        return false;
		}
		return false;
	}
	
	public function getRequestOrderId()
	{
		if (!isset($_REQUEST['orderNumberSberbank']) && isset($_REQUEST['orderId']))
		{

			$method_step = $this->config->get('method_step');
			
			$fields = array(
			'userName' => $this->config->get('merchant'),
			'password' => $this->config->get('password'),
			'orderId' => $_REQUEST['orderId']
			);
		
			if ($this->isDebug())
			{
				$action_adr = $this->config->get('API_URL_TEST');
			}
			else
			{
				$action_adr = $this->config->get('API_URL_PROD');
			}
			$action_adr .= 'getOrderStatus.do';
		
			$rbsCurl = curl_init();
			curl_setopt_array($rbsCurl, array(
			CURLOPT_URL => $action_adr,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($fields)
			));
			
			$response = curl_exec($rbsCurl);
			curl_close($rbsCurl);
			
			$this->logInfo("Запрос проверки состояния платежа: " . $action_adr . " | Параметры: " . http_build_query($fields) . " | Ответ: " . $response);
			
			$response = json_decode($response, true);
			$orderStatus = $response['OrderStatus'];
			$orderNumber = $response['OrderNumber'];

			if ($orderStatus == '1' || $orderStatus == '2') 
			{
				//Принудительно сами генерируем запрос callback
				$fields = array(
				'orderNumberSberbank' => $orderNumber,
				'orderStatus' => $orderStatus,
				'orderAmount' => $response['Amount'],
				'checkOrderId' => $_REQUEST['orderId']
				);
				
				$rbsCurlCallback = curl_init();
				curl_setopt_array($rbsCurlCallback, array(
				CURLOPT_URL => $this->_jbrouter->payment('callback'),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => http_build_query($fields)
				));
				
				$this->logInfo("Вызываем callback: " . $this->_jbrouter->payment('callback') . " | Параметры: " . http_build_query($fields));

				$response = curl_exec($rbsCurlCallback);
				curl_close($rbsCurlCallback);
				
				return $orderNumber;
			}
			else
			{
				$this->logInfo("В проведении платежа отказано!");
				return 0;
			}
		}
		else
		{
			return $_REQUEST['orderNumberSberbank'];
		}
		return 0;
	}
	
	public function getRequestOrderSum()
	{
		if (isset($_REQUEST['orderStatus']))
		{
			if ($_REQUEST['orderStatus'] == '1' || $_REQUEST['orderStatus'] == '2') 
			{
			        $order  = $this->getOrder();
				$orderId = $this->getOrderId();
				$payCurrency = $this->getDefaultCurrency();
				$orderAmount = $this->_order->val($this->getOrderSumm(), $order->getCurrency())->convert($payCurrency);
			        $orderAmountRequest = $this->_order->val((float)$this->_jbrequest->get('orderAmount') / 100, $order->getCurrency())->convert($payCurrency);
				if ((float)$orderAmount == (float)$orderAmountRequest)
				{
					$this->logInfo("Проверка суммы, ОК!");
					$amount = $orderAmount->val();
				        return $amount;
				}
				else
				{
					$this->logInfo("Суммы платежа не совпадают!");
				        return 0;
				}
			}
			else
			{
				$this->logInfo("Проверка суммы прошла с ошибкой! Статус платежа не равен 1 или 2.");
			        return 0;
			}
		}
		else
		{
			$this->logInfo("Проверка суммы прошла с ошибкой! Статус платежа не задан.");
		        return 0;
		}
		return 0;

		/*
		$this->logInfo("Проверка суммы, ОК!");
		$order = $this->getOrder();
		$orderId = $this->getOrderId();
		$payCurrency = $this->getDefaultCurrency();
		$orderAmount = $this->_order->val($this->getOrderSumm(), $order->getCurrency())->convert($payCurrency);
		$amount = $orderAmount->val();
		return $amount;
		*/
	}

	public function logInfo ($strMessage) {
		$file = JPATH_ROOT . "/logs/rbs_payment.log";
		$date = JFactory::getDate ();
		$fp = fopen ($file, 'a');
		fwrite ($fp, "\n" . $date->Format ('%Y-%m-%d %H:%M:%S') . " " . $strMessage);
		fclose ($fp);
	}

}
