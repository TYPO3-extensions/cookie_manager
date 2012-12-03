<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Cookie',
	'Cookie Control'
);
Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'CookieAccept',
	'Cookie Acceptance Pane'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_cookie';
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_cookie.xml');

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'manager',	// Submodule key
		'',						// Position
		array(
			'Cookie' => 'dispatch, new, create, show, edit, update, delete',
			'IPAddress' => 'list, show, new, create, delete',
			
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_manager.xml',
		)
	);

}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Cookie Manager');

t3lib_extMgm::addLLrefForTCAdescr('tx_cookiemanager_domain_model_cookie', 'EXT:cookie_manager/Resources/Private/Language/locallang_csh_tx_cookiemanager_domain_model_cookie.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_cookiemanager_domain_model_cookie');
$TCA['tx_cookiemanager_domain_model_cookie'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:cookie_manager/Resources/Private/Language/locallang_db.xml:tx_cookiemanager_domain_model_cookie',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,expire,path,domain,secure,group_cookies,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Cookie.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_cookiemanager_domain_model_cookie.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_cookiemanager_domain_model_groupcookie', 'EXT:cookie_manager/Resources/Private/Language/locallang_csh_tx_cookiemanager_domain_model_groupcookie.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_cookiemanager_domain_model_groupcookie');
$TCA['tx_cookiemanager_domain_model_groupcookie'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:cookie_manager/Resources/Private/Language/locallang_db.xml:tx_cookiemanager_domain_model_groupcookie',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/GroupCookie.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_cookiemanager_domain_model_groupcookie.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_cookiemanager_domain_model_ipaddress', 'EXT:cookie_manager/Resources/Private/Language/locallang_csh_tx_cookiemanager_domain_model_ipaddress.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_cookiemanager_domain_model_ipaddress');
$TCA['tx_cookiemanager_domain_model_ipaddress'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:cookie_manager/Resources/Private/Language/locallang_db.xml:tx_cookiemanager_domain_model_ipaddress',
		'label' => 'ip',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'ip,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/IPAddress.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_cookiemanager_domain_model_ipaddress.gif'
	),
);

?>