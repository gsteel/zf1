<?php
class Zend_Application_Resource_Frontcontroller extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Controller_Front
     */
    protected $_front;

    /**
     * Initialize Front Controller
     *
     * @return Zend_Controller_Front
     * @throws Zend_Application_Exception
     */
    public function init()
    {
        $front = $this->getFrontController();

        foreach ($this->getOptions() as $key => $value) {
            switch (strtolower($key)) {
            case 'controllerdirectory':
                if (is_string($value)) {
                    $front->setControllerDirectory($value);
                } elseif (is_array($value)) {
                    foreach ($value as $module => $directory) {
                        $front->addControllerDirectory($directory, $module);
                    }
                }
                break;

            case 'modulecontrollerdirectoryname':
                $front->setModuleControllerDirectoryName($value);
                break;

            case 'moduledirectory':
                if (is_string($value)) {
                    $front->addModuleDirectory($value);
                } elseif (is_array($value)) {
                    foreach ($value as $moduleDir) {
                        $front->addModuleDirectory($moduleDir);
                    }
                }
                break;

            case 'defaultcontrollername':
                $front->setDefaultControllerName($value);
                break;

            case 'defaultaction':
                $front->setDefaultAction($value);
                break;

            case 'defaultmodule':
                $front->setDefaultModule($value);
                break;

            case 'baseurl':
                if (!empty($value)) {
                    $front->setBaseUrl($value);
                }
                break;

            case 'params':
                $front->setParams($value);
                break;

            case 'plugins':
                foreach ((array) $value as $pluginClass) {
                    $stackIndex = null;
                    if (is_array($pluginClass)) {
                        $pluginClass = array_change_key_case($pluginClass, CASE_LOWER);
                        if (isset($pluginClass['class'])) {
                            if (isset($pluginClass['stackindex'])) {
                                $stackIndex = $pluginClass['stackindex'];
                            }

                            $pluginClass = $pluginClass['class'];
                        }
                    }

                    $plugin = new $pluginClass();
                    $front->registerPlugin($plugin, $stackIndex);
                }
                break;

            case 'returnresponse':
                $front->returnResponse((bool) $value);
                break;

            case 'throwexceptions':
                $front->throwExceptions((bool) $value);
                break;

            case 'actionhelperpaths':
                if (is_array($value)) {
                    foreach ($value as $helperPrefix => $helperPath) {
                        Zend_Controller_Action_HelperBroker::addPath($helperPath, $helperPrefix);
                    }
                }
                break;

            case 'dispatcher':
                if (!isset($value['class'])) {
                    throw new Zend_Application_Exception('You must specify both ');
                }
                if (!isset($value['params'])) {
                    $value['params'] = array();
                }
                    
                $dispatchClass = $value['class'];
                if (!class_exists($dispatchClass)) {
                    throw new Zend_Application_Exception('Dispatcher class not found!');
                }
                $front->setDispatcher(new $dispatchClass((array)$value['params']));
                break;
            default:
                $front->setParam($key, $value);
                break;
            }
        }

        if (null !== ($bootstrap = $this->getBootstrap())) {
            $this->getBootstrap()->frontController = $front;
        }

        return $front;
    }

    /**
     * Retrieve front controller instance
     *
     * @return Zend_Controller_Front
     */
    public function getFrontController()
    {
        if (null === $this->_front) {
            $this->_front = Zend_Controller_Front::getInstance();
        }
        return $this->_front;
    }
}
