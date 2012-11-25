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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_CookieManager_Domain_Model_Cookie.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Cookie Manager
 *
 * @author Henjo Hoeksma <hphoeksma@stylence.nl>
 */
class Tx_CookieManager_Domain_Model_CookieTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_CookieManager_Domain_Model_Cookie
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_CookieManager_Domain_Model_Cookie();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getExpireReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setExpireForStringSetsExpire() { 
		$this->fixture->setExpire('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getExpire()
		);
	}
	
	/**
	 * @test
	 */
	public function getPathReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPathForStringSetsPath() { 
		$this->fixture->setPath('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPath()
		);
	}
	
	/**
	 * @test
	 */
	public function getDomainReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDomainForStringSetsDomain() { 
		$this->fixture->setDomain('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDomain()
		);
	}
	
	/**
	 * @test
	 */
	public function getSecureReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getSecure()
		);
	}

	/**
	 * @test
	 */
	public function setSecureForBooleanSetsSecure() { 
		$this->fixture->setSecure(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getSecure()
		);
	}
	
	/**
	 * @test
	 */
	public function getGroupCookiesReturnsInitialValueForObjectStorageContainingTx_CookieManager_Domain_Model_GroupCookie() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getGroupCookies()
		);
	}

	/**
	 * @test
	 */
	public function setGroupCookiesForObjectStorageContainingTx_CookieManager_Domain_Model_GroupCookieSetsGroupCookies() { 
		$groupCooky = new Tx_CookieManager_Domain_Model_GroupCookie();
		$objectStorageHoldingExactlyOneGroupCookies = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneGroupCookies->attach($groupCooky);
		$this->fixture->setGroupCookies($objectStorageHoldingExactlyOneGroupCookies);

		$this->assertSame(
			$objectStorageHoldingExactlyOneGroupCookies,
			$this->fixture->getGroupCookies()
		);
	}
	
	/**
	 * @test
	 */
	public function addGroupCookyToObjectStorageHoldingGroupCookies() {
		$groupCooky = new Tx_CookieManager_Domain_Model_GroupCookie();
		$objectStorageHoldingExactlyOneGroupCooky = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneGroupCooky->attach($groupCooky);
		$this->fixture->addGroupCooky($groupCooky);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneGroupCooky,
			$this->fixture->getGroupCookies()
		);
	}

	/**
	 * @test
	 */
	public function removeGroupCookyFromObjectStorageHoldingGroupCookies() {
		$groupCooky = new Tx_CookieManager_Domain_Model_GroupCookie();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($groupCooky);
		$localObjectStorage->detach($groupCooky);
		$this->fixture->addGroupCooky($groupCooky);
		$this->fixture->removeGroupCooky($groupCooky);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getGroupCookies()
		);
	}
	
}
?>