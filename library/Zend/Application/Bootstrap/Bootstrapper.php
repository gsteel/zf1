<?php
interface Zend_Application_Bootstrap_Bootstrapper
{
    /**
     * Constructor
     *
     * @param Zend_Application $application
     */
    public function __construct($application);

    /**
     * Set bootstrap options
     *
     * @param  array $options
     * @return Zend_Application_Bootstrap_Bootstrapper
     */
    public function setOptions(array $options);

    /**
     * Retrieve application object
     *
     * @return Zend_Application|Zend_Application_Bootstrap_Bootstrapper
     */
    public function getApplication();

    /**
     * Retrieve application environment
     *
     * @return string
     */
    public function getEnvironment();

    /**
     * Retrieve list of class resource initializers (_init* methods). Returns
     * as resource/method pairs.
     *
     * @return array
     */
    public function getClassResources();

    /**
     * Retrieve list of class resource initializer names (resource names only,
     * no method names)
     *
     * @return array
     */
    public function getClassResourceNames();

    /**
     * Bootstrap application or individual resource
     *
     * @param  null|string $resource
     * @return mixed
     */
    public function bootstrap($resource = null);

    /**
     * Run the application
     *
     * @return void
     */
    public function run();
}
