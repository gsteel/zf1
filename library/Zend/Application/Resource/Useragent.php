<?php
class Zend_Application_Resource_UserAgent extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Http_UserAgent
     */
    protected $_userAgent;
    
    /**
     * Intialize resource
     *
     * @return Zend_Http_UserAgent
     */
    public function init()
    {
        $userAgent = $this->getUserAgent();

        // Optionally seed the UserAgent view helper
        $bootstrap = $this->getBootstrap();
        if ($bootstrap->hasResource('view') || $bootstrap->hasPluginResource('view')) {
            $bootstrap->bootstrap('view');
            $view = $bootstrap->getResource('view');
            if (null !== $view) {
                $view->userAgent($userAgent);
            }
        }

        return $userAgent;
    }
    
    /**
     * Get UserAgent instance
     *
     * @return Zend_Http_UserAgent
     */
    public function getUserAgent()
    {
        if (null === $this->_userAgent) {
            $options = $this->getOptions();
            $this->_userAgent = new Zend_Http_UserAgent($options);
        }
        
        return $this->_userAgent;
    }
}
