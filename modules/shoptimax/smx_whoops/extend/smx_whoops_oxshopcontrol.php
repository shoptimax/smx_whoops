<?php
/**
 * This software is property of shoptimax GmbH and is protected.
 * @copyright (c) shoptimax GmbH | 2013-2014
 * @package: smx_whoops
 * @author: Gernot Payer <payer@shoptimax.de>
 * @author: Stefan Moises <moises@shoptimax.de>
 * @version: 1.0.1
 */
 
class smx_whoops_oxshopcontrol extends smx_whoops_oxshopcontrol_parent
{
    /**
    * @var Whoops\Run Whoops run object
    */
    protected $_run = null;
    
    /**
     * Sets default exception handler.
     * Ideally all exceptions should be handled with try catch and default exception should never be reached.
     *
     * @return null;
     */
    protected function _setDefaultExceptionHandler()
    {
        if (isset($this->_blHandlerSet)) {
            return;
        }
        if ( ($this->isAdmin() && $this->getUser()) || !oxRegistry::getConfig()->isProductiveMode() || $this->_isDebugMode() ) {
            // load Whoops
            require getShopBasePath() . 'vendor/autoload.php';

            $this->_run = new Whoops\Run();
            $this->_run->pushHandler(new Whoops\Handler\PrettyPageHandler());
            $this->_run->register();
        }
        else {
            parent::_setDefaultExceptionHandler();
        }
    }
    
    /**
     * Shows exception message if debug mode is enabled, redirects otherwise.
     *
     * @param oxConnectionException $oEx message to show on exit
     */
    protected function _handleDbConnectionException( $oEx )
    {
        $oEx->debugOut();
        if ( ($this->isAdmin() && $this->getUser()) || !oxRegistry::getConfig()->isProductiveMode() || $this->_isDebugMode() ) {
            // let whoops do the fancy stuff :)
            $this->_run->handleException( $oEx );
        } else {
            header( "HTTP/1.1 500 Internal Server Error");
            header( "Location: offline.html");
            header( "Connection: close");
        }
    }
}
 