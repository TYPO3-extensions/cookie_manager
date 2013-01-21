<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Henjo Hoeksma <hphoeksma@stylence.nl>, Stylence
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package cookie_manager
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_CookieManager_Utility_IPUtility implements  t3lib_Singleton {

	/**
	 * This method looks to see if the user is behind a proxy
	 * and if so tries to reveal the real IP Address
	 *
	 * @return mixed The IPAddress of the user
	 */
	static public function getIPAddress() {

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