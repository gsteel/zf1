<?php
abstract class Zend_Controller_Router_Route_Abstract implements Zend_Controller_Router_Route_Interface
{
    /**
     * URI delimiter
     */
    const URI_DELIMITER = '/';

    /**
     * Wether this route is abstract or not
     *
     * @var boolean
     */
    protected $_isAbstract = false;

    /**
     * Path matched by this route
     *
     * @var string
     */
    protected $_matchedPath = null;

    /**
     * Get the version of the route
     *
     * @return integer
     */
    public function getVersion()
    {
        return 2;
    }

    /**
     * Set partially matched path
     *
     * @param  string $path
     * @return void
     */
    public function setMatchedPath($path)
    {
        $this->_matchedPath = $path;
    }

    /**
     * Get partially matched path
     *
     * @return string
     */
    public function getMatchedPath()
    {
        return $this->_matchedPath;
    }

    /**
     * Check or set wether this is an abstract route or not
     *
     * @param  boolean $flag
     * @return boolean
     */
    public function isAbstract($flag = null)
    {
        if ($flag !== null) {
            $this->_isAbstract = $flag;
        }

        return $this->_isAbstract;
    }

    /**
     * Create a new chain
     *
     * @param  Zend_Controller_Router_Route_Abstract $route
     * @param  string                                $separator
     * @return Zend_Controller_Router_Route_Chain
     */
    public function chain(Zend_Controller_Router_Route_Abstract $route, $separator = '/')
    {
        $chain = new Zend_Controller_Router_Route_Chain();
        $chain->chain($this)->chain($route, $separator);

        return $chain;
    }
}
