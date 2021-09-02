<?php
/**
 *	@author Md. Abdullah
 *	@since 2020-07-09
 *	@abstract To send SMS with ELITBUZZSmsAPI
 */
/**
 *	@author Ahsan Zahid Chowdhury
 *	@since 2021-07-26
 *	@abstract URL Update
 */
namespace App\Helpers;

use Carbon\Carbon;

class ELITBUZZSmsAPI
{
	private $APIToken;
	private $APIURL;
	function __construct()
	{
		$this->APIToken = env('ELITBUZZAPI_TOKEN', false);
		$this->APIURL = env('ELITBUZZAPI_URL', false);
	}

	private function sendSMSFlash($to, $message, $type, $scheduledDateTime = NULL) {
		$scheduledDateTime = ($scheduledDateTime == NULL)?Carbon::now()->toDateTimeString():$scheduledDateTime;
		if(!$this->APIToken || !$this->APIURL){
			return false;
		}

		$url = $this->APIURL;
		$data = [
			'api_key' => $this->APIToken,
			'type' => $type,
			'senderid' => env('SENDER_ID'),
			'contacts' => $to,
			'msg' => $message,
			'scheduledDateTime' => $scheduledDateTime,
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	public function send($to, $message, $type = 'flash', $scheduledDateTime = NULL){
		if(env("SEND_SMS",false)){
			return $this->sendSMSFlash(implode('+', $to), $message, $type, $scheduledDateTime);
		}
	}
}
?>