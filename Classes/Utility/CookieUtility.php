<?php

class Tx_CookieManager_Utility_CookieUtility implements t3lib_Singleton {

	/**
	 * Set main and groupcookies in one call
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @param boolean $value
	 * @return boolean
	 */
	public function setAllCookies(Tx_CookieManager_Domain_Model_Cookie $cookie, $value = FALSE) {
		self::setMainCookie($cookie, $value);
		self::setAllGroupCookies($cookie, $value);
		return TRUE;
	}

	/**
	 * This method sets the main cookie.
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @param boolean $value
	 * @return boolean
	 */
	public function setMainCookie(Tx_CookieManager_Domain_Model_Cookie $cookie, $value = FALSE) {
		return setcookie (
			$cookie->getName(),
			serialize($value),
			$expire = 0,
			$cookie->getPath(),
			$cookie->getDomain(),
			$cookie->getSecure() ? $cookie->getSecure() : FALSE,
			$httponly = false
		);
	}

	/**
	 * This method sets all group cookies with one call.
	 * Used in the initial phase.
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @param boolean $value
	 * @return boolean
	 */
	public function setAllGroupCookies(Tx_CookieManager_Domain_Model_Cookie $cookie, $value = FALSE) {
		foreach ($cookie->getGroupCookies() as $groupCookie) {
			setcookie (
				$cookie->getName() . '_' . $groupCookie->getName(),
				serialize($value),
				$expire = 0,
				$cookie->getPath(),
				$cookie->getDomain(),
				$cookie->getSecure() ? $cookie->getSecure() : FALSE,
				$httponly = false
			);
		}
		// If a groupCookie is set, we need the main cookie as well
		self::setMainCookie($cookie, $value);

		return TRUE;
	}

	/**
	 * This method sets a group cookie based on a given name.
	 * These names must match exactly.
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @param bool $value
	 * @param string $name
	 * @return boolean
	 */
	public function setGroupCookieByName(Tx_CookieManager_Domain_Model_Cookie $cookie, $value = FALSE, $name = '') {
		foreach ($cookie->getGroupCookies() as $groupCookie) {
			if($groupCookie->getName() === $name) {
				setcookie (
					$cookie->getName() . '_' . $groupCookie->getName(),
					serialize($value),
					$expire = 0,
					$cookie->getPath(),
					$cookie->getDomain(),
					$cookie->getSecure() ? $cookie->getSecure() : FALSE,
					$httponly = false
				);
			}
		}
		return TRUE;
	}
}
?>