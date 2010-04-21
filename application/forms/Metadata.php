<?php

class Application_Form_Metadata extends Zend_Form_Subform
{
	public function setDefaults(array $defaults)
    {
    	foreach ($defaults AS $personMeta) {
    		if ($personMeta instanceof Application_Model_PersonMetadata) {
    			$this->_addProjectKey();
                $this->setDefault('key', $personMeta->getKey());
            	
                $this->_addProjectValue();
                $this->setDefault('value', $personMeta->getValue());
    		}
    	}
        parent::setDefaults($defaults);
    }
    
    public function init()
    {
    	$key = $this->addElement('text', 'key', array(
            'filters' => array('StringTrim'),
            'required'   => true,
            'label'      => 'Key:',
        ));
     
        $value = $this->addElement('text', 'value', array(
            'filters' => array('StringTrim'),
            'required'   => true,
            'label'      => 'Value:',
        ));
     
    }
        
	protected function _addProjectKey()
    {
        $key = $this->addElement('text', 'key', array(
            'filters' => array('StringTrim'),
            'required'   => true,
            'label'      => 'Key:',
        ));
    }
    
	protected function _addProjectValue()
    {
        $key = $this->addElement('text', 'value', array(
            'filters' => array('StringTrim'),
            'required'   => true,
            'label'      => 'Value:',
        ));
    }
	

}

