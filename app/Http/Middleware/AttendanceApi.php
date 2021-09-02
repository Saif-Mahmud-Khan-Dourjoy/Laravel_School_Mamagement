<?php

namespace App\Http\Middleware;

use Closure;

class AttendanceApi
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

	public function handle($request, Closure $next)
	{
		if(!$request->encVal || !$request->encKey){
			abort(401);
		}else{
			$HamzaApiVI = env('HamzaApiVI');
    		$HamzaApiVal = env('HamzaApiVal');

    		if(!$this->_decrypt_aes256($request->encVal, $request->encKey, $HamzaApiVI) == $HamzaApiVal){
    			abort(401);
    		}
		}

		return $next($request);
	}

	private function _encrypt_aes256($clear_text, $key, $iv) {
        $iv = str_pad($iv, 16, "\0");
        $encrypt_text = openssl_encrypt($clear_text, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $data = base64_encode($encrypt_text);
        return $data;
    }
    private function _decrypt_aes256($data, $key, $iv) {
        $iv = str_pad($iv, 16, "\0");
        $encrypt_text = base64_decode($data);
        $clear_text = openssl_decrypt($encrypt_text, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        return $clear_text;
    }
}
