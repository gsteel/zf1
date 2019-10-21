<?php
class Zend_Controller_Action_Helper_AutoCompleteDojo extends Zend_Controller_Action_Helper_AutoComplete_Abstract
{
    /**
     * Validate data for autocompletion
     *
     * Stub; unused
     *
     * @param  mixed $data
     * @return boolean
     */
    public function validateData($data)
    {
        return true;
    }

    /**
     * Prepare data for autocompletion
     *
     * @param  mixed   $data
     * @param  boolean $keepLayouts
     * @return string
     */
    public function prepareAutoCompletion($data, $keepLayouts = false)
    {
        if (!$data instanceof Zend_Dojo_Data) {
            require_once 'Zend/Dojo/Data.php';
            $items = array();
            foreach ($data as $key => $value) {
                $items[] = array('label' => $value, 'name' => $value);
            }
            $data = new Zend_Dojo_Data('name', $items);
        }

        if (!$keepLayouts) {
            Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->setNoRender(true);

            $layout = Zend_Layout::getMvcInstance();
            if ($layout instanceof Zend_Layout) {
                $layout->disableLayout();
            }
        }

        $response = Zend_Controller_Front::getInstance()->getResponse();
        $response->setHeader('Content-Type', 'application/json');

        return $data->toJson();
    }
}
