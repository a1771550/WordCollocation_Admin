<?php

namespace api\controllers;
use yii\web\Controller;

class BaseController extends Controller
{
	/* Functions to set header with status code. eg: 200 OK ,400 Bad Request etc..*/
	protected function setHeader($status)
	{

		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		//$content_type="application/json; charset=utf-8";
		$content_type="application/x-javascript; charset=utf-8";

		header($status_header);
		header('Content-type: ' . $content_type);
		header('X-Powered-By: ' . "Kevin Lau <translationhall.com>");
	}
	private function _getStatusCodeMessage($status)
	{
		$codes = Array(
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}
}