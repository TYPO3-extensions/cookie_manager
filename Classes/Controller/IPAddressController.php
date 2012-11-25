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
class Tx_CookieManager_Controller_IPAddressController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$iPAddresses = $this->iPAddressRepository->findAll();
		$this->view->assign('iPAddresses', $iPAddresses);
	}

	/**
	 * action show
	 *
	 * @param Tx_CookieManager_Domain_Model_IPAddress $iPAddress
	 * @return void
	 */
	public function showAction(Tx_CookieManager_Domain_Model_IPAddress $iPAddress) {
		$this->view->assign('iPAddress', $iPAddress);
	}

	/**
	 * action new
	 *
	 * @param Tx_CookieManager_Domain_Model_IPAddress $newIPAddress
	 * @dontvalidate $newIPAddress
	 * @return void
	 */
	public function newAction(Tx_CookieManager_Domain_Model_IPAddress $newIPAddress = NULL) {
		$this->view->assign('newIPAddress', $newIPAddress);
	}

	/**
	 * action create
	 *
	 * @param Tx_CookieManager_Domain_Model_IPAddress $newIPAddress
	 * @return void
	 */
	public function createAction(Tx_CookieManager_Domain_Model_IPAddress $newIPAddress) {
		$this->iPAddressRepository->add($newIPAddress);
		$this->flashMessageContainer->add('Your new IPAddress was created.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param Tx_CookieManager_Domain_Model_IPAddress $iPAddress
	 * @return void
	 */
	public function deleteAction(Tx_CookieManager_Domain_Model_IPAddress $iPAddress) {
		$this->iPAddressRepository->remove($iPAddress);
		$this->flashMessageContainer->add('Your IPAddress was removed.');
		$this->redirect('list');
	}

}
?>