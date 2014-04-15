<?php
/**
 * This software is property of shoptimax GmbH and is protected.
 * @copyright (c) shoptimax GmbH | 2013-2014
 * @package: smx_whoops
 * @author: Gernot Payer <payer@shoptimax.de>
 * @author: Stefan Moises <moises@shoptimax.de>
 * @version: 1.0.2
 */
 
class smx_whoops_oxshopcontrol extends smx_whoops_oxshopcontrol_parent
{
    /**
    * @var Whoops\Run Whoops run object
    */
    protected $_run = null;
    
    
    /**
     * render oxView object
     *
     * @param oxView $oViewObject view object to render
     *
     * @return string
     */
    protected function _render($oViewObject)
    {
        $sTemplateName = $oViewObject->render();
        // check if template dir exists, if not let Whoops! display this error, too!
        $sTemplateFile = $this->getConfig()->getTemplatePath( $sTemplateName, $this->isAdmin() ) ;
        if ( $this->_showExtendedExceptionInfo() && !file_exists( $sTemplateFile)) {

            $oEx = oxNew( 'oxSystemComponentException' );
            $oEx->setMessage( 'EXCEPTION_SYSTEMCOMPONENT_TEMPLATENOTFOUND' . " Template: " . $sTemplateName);
            $oEx->setComponent( $sTemplateName );
            // let whoops do the fancy stuff :)
            $this->_run->handleException( $oEx );
        }
        return parent::_render($oViewObject);
    }
    
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
        if ( $this->_showExtendedExceptionInfo() ) {
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
        if ( $this->_showExtendedExceptionInfo() ) {
            // let whoops do the fancy stuff :)
            $this->_run->handleException( $oEx );
        } else {
            parent::_handleDbConnectionException( $oEx );
        }
    }
    
    /**
     * Shows exceptionError page.
     * possible reason: class does not exist etc. --> just redirect to start page.
     *
     * @param $oEx
     */
    protected function _handleSystemException( $oEx )
    {
        if ( $this->_showExtendedExceptionInfo() ) {
            // let whoops do the fancy stuff :)
            $this->_run->handleException( $oEx );
        }
        else {
            parent::_handleSystemException( $oEx );
        }
    }
    
    /**
     * Redirect to start page, in debug mode shows error message.
     *
     * @param $oEx
     */
    protected function _handleCookieException( $oEx )
    {
        if ( $this->_showExtendedExceptionInfo() ) {
            // let whoops do the fancy stuff :)
            $this->_run->handleException( $oEx );
        }
        else {
            parent::_handleCookieException( $oEx );
        }
    }
    
    /**
     * Catching other not cought exceptions.
     *
     * @param oxException $oEx
     */
    protected function _handleBaseException( $oEx )
    {
        if ( $this->_showExtendedExceptionInfo() ) {
            // let whoops do the fancy stuff :)
            $this->_run->handleException( $oEx );
        }
        else {
            parent::_handleBaseException( $oEx );
        }
    }
    
    /**
     * Determine if we should display extended exception info, e.g. when in debug or non-productive
     * shop mode or in admin area / backend of the shop.
     * @return boolean
     */
    protected function _showExtendedExceptionInfo() {
        return ( ($this->isAdmin() && $this->getUser()) || !oxRegistry::getConfig()->isProductiveMode() || $this->_isDebugMode() );
    }
}
 