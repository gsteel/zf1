<?php
abstract class Zend_Controller_Action_Helper_Abstract
{
    /**
     * $_actionController
     *
     * @var Zend_Controller_Action $_actionController
     */
    protected $_actionController = null;

    /**
     * @var mixed $_frontController
     */
    protected $_frontController = null;

    /**
     * setActionController()
     *
     * @param  Zend_Controller_Action $actionController
     * @return Zend_Controller_ActionHelper_Abstract Provides a fluent interface
     */
    public function setActionController(Zend_Controller_Action $actionController = null)
    {
        $this->_actionController = $actionController;
        return $this;
    }

    /**
     * Retrieve current action controller
     *
     * @return Zend_Controller_Action
     */
    public function getActionController()
    {
        return $this->_actionController;
    }

    /**
     * Retrieve front controller instance
     *
     * @return Zend_Controller_Front
     */
    public function getFrontController()
    {
        return Zend_Controller_Front::getInstance();
    }

    /**
     * Hook into action controller initialization
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Hook into action controller preDispatch() workflow
     *
     * @return void
     */
    public function preDispatch()
    {
    }

    /**
     * Hook into action controller postDispatch() workflow
     *
     * @return void
     */
    public function postDispatch()
    {
    }

    /**
     * getRequest() -
     *
     * @return Zend_Controller_Request_Abstract $request
     */
    public function getRequest()
    {
        $controller = $this->getActionController();
        if (null === $controller) {
            $controller = $this->getFrontController();
        }

        return $controller->getRequest();
    }

    /**
     * getResponse() -
     *
     * @return Zend_Controller_Response_Abstract $response
     */
    public function getResponse()
    {
        $controller = $this->getActionController();
        if (null === $controller) {
            $controller = $this->getFrontController();
        }

        return $controller->getResponse();
    }

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        $fullClassName = get_class($this);
        if (strpos($fullClassName, '_') !== false) {
            $helperName = strrchr($fullClassName, '_');
            return ltrim($helperName, '_');
        } elseif (strpos($fullClassName, '\\') !== false) {
            $helperName = strrchr($fullClassName, '\\');
            return ltrim($helperName, '\\');
        } else {
            return $fullClassName;
        }
    }
}
