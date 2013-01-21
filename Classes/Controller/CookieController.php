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
class Tx_CookieManager_Controller_CookieController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * cookieRepository
	 *
	 * @var Tx_CookieManager_Domain_Repository_CookieRepository
	 */
	protected $cookieRepository;

	/**
	 * injectCookieRepository
	 *
	 * @param Tx_CookieManager_Domain_Repository_CookieRepository $cookieRepository
	 * @return void
	 */
	public function injectCookieRepository(Tx_CookieManager_Domain_Repository_CookieRepository $cookieRepository) {
		$this->cookieRepository = $cookieRepository;
	}

	/**
	 * IPAddressRepository
	 *
	 * @var Tx_CookieManager_Domain_Repository_IPAddressRepository
	 */
	protected $IPAddressRepository;

	/**
	 * injectIPAddressRepository
	 *
	 * @param Tx_CookieManager_Domain_Repository_IPAddressRepository $IPAddressRepository
	 * @return void
	 */
	public function injectIPAddressRepository(Tx_CookieManager_Domain_Repository_IPAddressRepository $IPAddressRepository) {
		$this->IPAddressRepository = $IPAddressRepository;
	}

	/**
	 * List action
	 *
	 * @return void
	 */
	public function listAction() {
		$cookies = $this->cookieRepository->findAll();
		$this->view->assign('cookies', $cookies);
	}

	/**
	 * action show
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @return void
	 */
	public function showAction(Tx_CookieManager_Domain_Model_Cookie $cookie) {
		$this->view->assign('cookie', $cookie);
	}

	/**
	 * action new
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $newCookie
	 * @dontvalidate $newCookie
	 * @return void
	 */
	public function newAction(Tx_CookieManager_Domain_Model_Cookie $newCookie = NULL) {
		if ($newCookie == NULL) { // workaround for fluid bug ##5636
			$newCookie = t3lib_div::makeInstance('Tx_CookieManager_Domain_Model_Cookie');
		}
		$this->view->assign('newCookie', $newCookie);
	}

	/**
	 * action create
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $newCookie
	 * @return void
	 */
	public function createAction(Tx_CookieManager_Domain_Model_Cookie $newCookie) {
		$this->cookieRepository->add($newCookie);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('bemod.created', $this->extensionName));
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @dontvalidate $cookie
	 * @return void
	 */
	public function editAction(Tx_CookieManager_Domain_Model_Cookie $cookie) {
		$this->view->assign('cookie', $cookie);
	}

	/**
	 * action update
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @return void
	 */
	public function updateAction(Tx_CookieManager_Domain_Model_Cookie $cookie) {
		$this->cookieRepository->update($cookie);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('bemod.updated', $this->extensionName));
		$this->redirect('edit', NULL, NULL, array('cookie' => $cookie));
	}

	/**
	 * action delete
	 *
	 * @param Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @return void
	 */
	public function deleteAction(Tx_CookieManager_Domain_Model_Cookie $cookie) {
		$this->cookieRepository->remove($cookie);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('bemod.deleted', $this->extensionName));
		$this->redirect('new');
	}

	/**
	 * action createCookie
	 *
	 * @param bool $allow
	 * @return string
	 */
	public function createCookieAction($allow = FALSE) {
		$cookies = $this->cookieRepository->findAll();
		// Make sure it is recognized as boolean
		$allow = ($allow === '1');
		// Set the correct response message
		if ($allow) {
			$msg = 'fe.allowed.1';
		} else {
			$msg = 'fe.allowed.0';
		}

		if ($cookies->count()) {
			Tx_CookieManager_Service_CookieService::setAllCookies($cookies, $allow);
			// Log the IP address
			$this->logIPAddress();
			// Set result message
			$result = array(
				'ip' => Tx_CookieManager_Utility_IPUtility::getIPAddress(),
				'msg' => Tx_Extbase_Utility_Localization::translate($msg, $this->extensionName)
			);
			return json_encode($result);
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('fe.error.noCookies', $this->extensionName), '', t3lib_FlashMessage::ERROR);
		}
	}

	/**
	 * @return void
	 */
	public function updateCookieAction() {

		$arguments = $this->request->getArguments();
		foreach ($arguments['cookies'] as $key => $value) {
			$cookie = $this->cookieRepository->findByUid($key);
			Tx_CookieManager_Service_CookieService::setCookie($cookie, $value);
			if ($value) {
				// Log the IP address
				$this->logIPAddress();
			}
		}

		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('fe.updated', $this->extensionName), '', t3lib_FlashMessage::OK);
		$this->redirect('editCookie');
	}

	/**
	 * action acceptCookie checks whether the clients has a cookie based matching ours
	 *
	 * @param boolean $clientHasCookies
	 * @return void
	 */
	public function acceptCookieAction($clientHasCookies = FALSE) {
		$cookies = $this->cookieRepository->findAll();
		if ($cookies->count()) {
			foreach ($cookies as $cookie) {
				$clientHasCookie = $_COOKIE[$cookie->getName()];
				if ($clientHasCookie) {
					// If we get this far we know the client has our cookie(s)
					$clientHasCookies = TRUE;
				}
			}
			$this->view->assign('cookie', $clientHasCookies);
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('fe.error.noCookies', $this->extensionName), '', t3lib_FlashMessage::ERROR);
		}
	}

	/**
	 * action editCookie
	 *
	 * @return void
	 */
	public function editCookieAction() {
		$cookies = $this->cookieRepository->findAll();

		$cookiesArray = array();
		foreach ($cookies as $cookie) {
			$cookiesArray[] = array(
				'cookie' => $cookie,
				'value' => unserialize($_COOKIE[$cookie->getName()])
			);
		}
		$this->view->assign('cookies', $cookiesArray);
	}

	/**
	 * @return void
	 */
	public function logIPAddress() {
		if ($this->settings['logIpAddresses']) {
			$IPAddress = $this->objectManager->create('Tx_CookieManager_Domain_Model_IPAddress');
			$IPAddress->setIp(Tx_CookieManager_Utility_IPUtility::getIPAddress());
			$this->IPAddressRepository->add($IPAddress);
		}
	}

}
?>