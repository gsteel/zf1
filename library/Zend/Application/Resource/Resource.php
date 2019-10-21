<?php
interface Zend_Application_Resource_Resource
{
    /**
     * Constructor
     *
     * Must take an optional single argument, $options.
     *
     * @param  mixed $options
     */
    public function __construct($options = null);

    /**
     * Set the bootstrap to which the resource is attached
     *
     * @param  Zend_Application_Bootstrap_Bootstrapper $bootstrap
     * @return Zend_Application_Resource_Resource
     */
    public function setBootstrap(Zend_Application_Bootstrap_Bootstrapper $bootstrap);

    /**
     * Retrieve the bootstrap to which the resource is attached
     *
     * @return Zend_Application_Bootstrap_Bootstrapper
     */
    public function getBootstrap();

    /**
     * Set resource options
     *
     * @param  array $options
     * @return Zend_Application_Resource_Resource
     */
    public function setOptions(array $options);

    /**
     * Retrieve resource options
     *
     * @return array
     */
    public function getOptions();

    /**
     * Strategy pattern: initialize resource
     *
     * @return mixed
     */
    public function init();
}
