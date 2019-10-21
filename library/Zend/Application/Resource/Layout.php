<?php
class Zend_Application_Resource_Layout
    extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Layout
     */
    protected $_layout;

    /**
     * Defined by Zend_Application_Resource_Resource
     *
     * @return Zend_Layout
     */
    public function init()
    {
        $this->getBootstrap()->bootstrap('FrontController');
        return $this->getLayout();
    }

    /**
     * Retrieve layout object
     *
     * @return Zend_Layout
     */
    public function getLayout()
    {
        if (null === $this->_layout) {
            $this->_layout = Zend_Layout::startMvc($this->getOptions());
        }
        return $this->_layout;
    }
}
