<?php
/**
 * @link      http://www.shoptimax.de/
 * @package   shoptimax
 * @copyright (C) shoptimax GmbH 2003-2013
 * @version   OXID eShop EE
 * @version   1.0
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
    'id'            => 'smx_whoops',
    'title'         => 'smxWhoops',
    'description'   => 'Whoops for OXID',
    'description'   => array(
        'de' => 'Whoops für OXID',
        'en' => 'Whoops for OXID',
    ),
    'thumbnail'     => 'logo.png',
    'version'       => '1.0.1',
    'email'         => 'module@shoptimax.de',
    'author'        => 'shoptimax GmbH',
    'url'           => 'http://www.shoptimax.de/',
	'files'         => array(
    ),
    'extend'        => array(
        'oxshopcontrol' => 'shoptimax/smx_whoops/extend/smx_whoops_oxshopcontrol',
    ),
    'templates'     => array(
    ),
    'blocks'        => array(
    ),
    'settings'      => array(),
    'events' => array(
    ),
);