<?php
class Zend_Controller_Action_Helper_AutoCompleteScriptaculous extends Zend_Controller_Action_Helper_AutoComplete_Abstract
{
    /**
     * Validate data for autocompletion
     *
     * @param  mixed $data
     * @return bool
     */
    public function validateData($data)
    {
        if (!is_array($data) && !is_scalar($data)) {
            return false;
        }

        return true;
    }

    /**
     * Prepare data for autocompletion
     *
     * @param  mixed   $data
     * @param  boolean $keepLayouts
     * @throws Zend_Controller_Action_Exception
     * @return string
     */
    public function prepareAutoCompletion($data, $keepLayouts = false)
    {
        if (!$this->validateData($data)) {
            throw new Zend_Controller_Action_Exception('Invalid data passed for autocompletion');
        }

        $data = (array) $data;
        $data = '<ul><li>' . implode('</li><li>', $data) . '</li></ul>';

        if (!$keepLayouts) {
            $this->disableLayouts();
        }

        return $data;
    }
}
