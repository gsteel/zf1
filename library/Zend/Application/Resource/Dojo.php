<?php
class Zend_Application_Resource_Dojo
    extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Dojo_View_Helper_Dojo_Container
     */
    protected $_dojo;

    /**
     * Defined by Zend_Application_Resource_Resource
     *
     * @return Zend_Dojo_View_Helper_Dojo_Container
     */
    public function init()
    {
        return $this->getDojo();
    }

    /**
     * Retrieve Dojo View Helper
     *
     * @return Zend_Dojo_View_Dojo_Container
     */
    public function getDojo()
    {
        if (null === $this->_dojo) {
            $this->getBootstrap()->bootstrap('view');
            $view = $this->getBootstrap()->view;

            Zend_Dojo::enableView($view);
            $view->dojo()->setOptions($this->getOptions());

            $this->_dojo = $view->dojo();
        }

        return $this->_dojo;
    }
}
