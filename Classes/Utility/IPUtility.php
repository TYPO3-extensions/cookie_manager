<?php

class Tx_CookieManager_Utility_IPUtility implements  t3lib_Singleton {

	/**
	 * This method looks to see if the user is behind a proxy
	 * and if so tries to reveal the real IP Address
	 *
	 * @return mixed The IPAddress of the user
	 */
	public function  getIPAddress() {

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$IPAddress = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$IPAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$IPAddress = $_SERVER['REMOTE_ADDR'];
		}

		return $IPAddress;
	}
}

?>