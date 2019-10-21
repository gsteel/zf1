<?php
class Zend_Controller_Action_Helper_AjaxContext extends Zend_Controller_Action_Helper_ContextSwitch
{
    /**
     * Controller property to utilize for context switching
     * @var string
     */
    protected $_contextKey = 'ajaxable';

    /**
     * Constructor
     *
     * Add HTML context
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->addContext('html', array('suffix' => 'ajax'));
    }

    /**
     * Initialize AJAX context switching
     *
     * Checks for XHR requests; if detected, attempts to perform context switch.
     *
     * @param  string $format
     * @return void
     */
    public function initContext($format = null)
    {
        $this->_currentContext = null;

        $request = $this->getRequest();
        if (!method_exists($request, 'isXmlHttpRequest') ||
            !$this->getRequest()->isXmlHttpRequest())
        {
            return;
        }

        return parent::initContext($format);
    }
}
