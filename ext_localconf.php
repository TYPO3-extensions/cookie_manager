<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Cookie',
	array(
		'Cookie' => 'editCookie, acceptCookie, createCookie, updateCookie, deleteCookie',
		
	),
	// non-cacheable actions
	array(
		'Cookie' => 'acceptCookie, editCookie, createCookie, updateCookie, deleteCookie',
		
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'CookieAccept',
	array(
		'Cookie' => 'acceptCookie, createCookie',

	),
	// non-cacheable actions
	array(
		'Cookie' => 'acceptCookie, editCookie',

	)
);
?>