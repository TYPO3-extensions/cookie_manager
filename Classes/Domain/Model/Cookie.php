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
class Tx_CookieManager_Domain_Model_Cookie extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Cookie name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Cookie lifetime
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $expire;

	/**
	 * Cookie path
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $path;

	/**
	 * Cookie domain
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $domain;

	/**
	 * Secured Connection Only Cookie
	 *
	 * @var boolean
	 */
	protected $secure = FALSE;

	/**
	 * GroupCookies
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_CookieManager_Domain_Model_GroupCookie>
	 * @lazy
	 */
	protected $groupCookies;

	/**
	 * __construct
	 *
	 * @return
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->groupCookies = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the expire
	 *
	 * @return string $expire
	 */
	public function getExpire() {
		return $this->expire;
	}

	/**
	 * Sets the expire
	 *
	 * @param string $expire
	 * @return void
	 */
	public function setExpire($expire) {
		$this->expire = $expire;
	}

	/**
	 * Returns the path
	 *
	 * @return string $path
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * Sets the path
	 *
	 * @param string $path
	 * @return void
	 */
	public function setPath($path) {
		$this->path = $path;
	}

	/**
	 * Returns the domain
	 *
	 * @return string $domain
	 */
	public function getDomain() {
		return $this->domain;
	}

	/**
	 * Sets the domain
	 *
	 * @param string $domain
	 * @return void
	 */
	public function setDomain($domain) {
		$this->domain = $domain;
	}

	/**
	 * Returns the secure
	 *
	 * @return boolean $secure
	 */
	public function getSecure() {
		return $this->secure;
	}

	/**
	 * Sets the secure
	 *
	 * @param boolean $secure
	 * @return void
	 */
	public function setSecure($secure) {
		$this->secure = $secure;
	}

	/**
	 * Returns the boolean state of secure
	 *
	 * @return boolean
	 */
	public function isSecure() {
		return $this->getSecure();
	}

	/**
	 * Adds a GroupCookie
	 *
	 * @param Tx_CookieManager_Domain_Model_GroupCookie $groupCooky
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CookieManager_Domain_Model_GroupCookie> groupCookies
	 */
	public function addGroupCooky(Tx_CookieManager_Domain_Model_GroupCookie $groupCooky) {
		$this->groupCookies->attach($groupCooky);
	}

	/**
	 * Removes a GroupCookie
	 *
	 * @param Tx_CookieManager_Domain_Model_GroupCookie $groupCookyToRemove The GroupCookie to be removed
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CookieManager_Domain_Model_GroupCookie> groupCookies
	 */
	public function removeGroupCooky(Tx_CookieManager_Domain_Model_GroupCookie $groupCookyToRemove) {
		$this->groupCookies->detach($groupCookyToRemove);
	}

	/**
	 * Returns the groupCookies
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CookieManager_Domain_Model_GroupCookie> groupCookies
	 */
	public function getGroupCookies() {
		return $this->groupCookies;
	}

	/**
	 * Sets the groupCookies
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_CookieManager_Domain_Model_GroupCookie> $groupCookies
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CookieManager_Domain_Model_GroupCookie> groupCookies
	 */
	public function setGroupCookies(Tx_Extbase_Persistence_ObjectStorage $groupCookies) {
		$this->groupCookies = $groupCookies;
	}

}
?>