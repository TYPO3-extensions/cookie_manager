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
	 * dispatchAction
	 *
	 * @param null|Tx_CookieManager_Domain_Model_Cookie $cookie
	 * @return void
	 */
	public function dispatchAction(Tx_CookieManager_Domain_Model_Cookie $cookie = NULL) {
		$arguments = $this->request->getArguments();
		if ($cookie !== NULL) {
			$action = $arguments['action'] ? $arguments['action'] : 'show';
			$this->redirect($action, NULL, NULL, array('cookie' => $cookie));
		} else {
			$cookie = $this->cookieRepository->findAll()->getFirst();
			if ($cookie) {
				$this->forward('show', NULL, NULL, array('cookie' => $cookie));
			} else {
				$this->redirect('new');
			}
		}
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
		$this->flashMessageContainer->add('Your new Cookie was created.');
		$this->redirect('dispatch');
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
		$groupCookies = $cookie->getGroupCookies();
		foreach ($groupCookies as $groupCookie) {
			if ($groupCookie->getName() === '') {
				$cookie->removeGroupCooky($groupCookie);
			}
		}
		$this->cookieRepository->update($cookie);
		$this->flashMessageContainer->add('Your Cookie was updated.');
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
		$this->flashMessageContainer->add('Your Cookie was removed.');
		$this->redirect('new');
	}

	/**
	 * action createCookie
	 *
	 * @return void
	 */
	public function createCookieAction() {

	}

	/**
	 * action deleteCookie
	 *
	 * @return void
	 */
	public function deleteCookieAction() {

	}

	/**
	 * action updateCookie
	 *
	 * @return void
	 */
	public function updateCookieAction() {

	}

	/**
	 * action acceptCookie
	 *
	 * @return void
	 */
	public function acceptCookieAction() {

	}

	/**
	 * action editCookie
	 *
	 * @return void
	 */
	public function editCookieAction() {

	}

}
?>