<?php
class Zend_Application_Resource_Cachemanager extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Cache_Manager
     */
    protected $_manager = null;

    /**
     * Initialize Cache_Manager
     *
     * @return Zend_Cache_Manager
     */
    public function init()
    {
        return $this->getCacheManager();
    }

    /**
     * Retrieve Zend_Cache_Manager instance
     *
     * @return Zend_Cache_Manager
     */
    public function getCacheManager()
    {
        if (null === $this->_manager) {
            $this->_manager = new Zend_Cache_Manager;

            $options = $this->getOptions();
            foreach ($options as $key => $value) {
                // Logger
                if (isset($value['frontend']['options']['logger'])) {
                    $logger = $value['frontend']['options']['logger'];
                    if (is_array($logger)) {
                        $value['frontend']['options']['logger'] = Zend_Log::factory($logger);
                    }
                }

                // Cache templates
                if ($this->_manager->hasCacheTemplate($key)) {
                    $this->_manager->setTemplateOptions($key, $value);
                } else {
                    $this->_manager->setCacheTemplate($key, $value);
                }
            }
        }

        return $this->_manager;
    }
}
