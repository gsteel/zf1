<?php
class Zend_Application_Resource_Log
    extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Log
     */
    protected $_log;

    /**
     * Defined by Zend_Application_Resource_Resource
     *
     * @return Zend_Log
     */
    public function init()
    {
        return $this->getLog();
    }

    /**
     * Attach logger
     *
     * @param  Zend_Log $log
     * @return Zend_Application_Resource_Log
     */
    public function setLog(Zend_Log $log)
    {
        $this->_log = $log;
        return $this;
    }

    /**
     * Retrieve logger object
     *
     * @return Zend_Log
     */
    public function getLog()
    {
        if (null === $this->_log) {
            $options = $this->getOptions();
            $log = Zend_Log::factory($options);
            $this->setLog($log);
        }
        return $this->_log;
    }
}
