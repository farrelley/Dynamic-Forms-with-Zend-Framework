<?php

class Application_Form_Person extends Zend_Form
{

	public function isValid($data) 
	{
        $subform = $this->getSubForm('new');
        // make sure new is array (won't be in $data if nothing submitted)
        if (!isset($data['new'])) {
            $data['new'] = array();
        }
        foreach ($data['new'] as $idx => $values) {
    		$metaform = new Application_Form_Metadata();
        	$subform->addSubForm($metaform, (string) $idx);
        }
        // call parent, which will populate newly created elements.
        return parent::isValid($data);
    }
    

 	public function init()
    {
    	$hiddenId = $this->addElement('hidden', 'id', array(
    		'id' => 'counter',
    		'value' => 1,
    		'ignore' => true,
    	));
    	    	
		$project = $this->addElement('text', 'firstName', array(
            'required'   => true,
            'label'      => 'First Name:',
        ));
        
        $project = $this->addElement('text', 'lastName', array(
            'required'   => true,
            'label'      => 'Last Name:',
        ));
       	
       	$this->addSubForm(
            new Zend_Form_SubForm(),
            'metadata'
        );

		$this->addSubForm(
            new Zend_Form_SubForm(),
            'new'
        );
        
		//cloning the default one. rename via js to new...        
        $default = new Zend_Form_SubForm();
        $this->addSubForm($default, 'default');
        
       	$subform = new Application_Form_Metadata();
        $this->default->addSubForm($subform, "base");
        $this->default->base->key->setRequired(false);
        $this->default->base->value->setRequired(false);
        
        $button = $this->addElement('button', 'button', array(
        	'id' => 'omg',
        	'required' => false,
            'ignore'   => true,
            'label'    => 'add key/value',
        ));
                        
        $submit = $this->addElement('submit', 'submit', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Add',
        ));  
    } 
    
    public function addme($id)
    {	
    	$metadata = $this->getSubForm('metadata');
    	$subform = new Application_Form_Metadata();
        $metadata->addSubForm($subform, (string) $id);
    }
   
	public function setDefaults(array $defaults)
    {
        $metadata = $this->getSubForm('metadata');
        $metadata->clearSubForms();
        
        foreach ($defaults AS $key => $personMeta) {
        	if ($personMeta instanceof Application_Model_PersonMetadata) {
        		$subform = new Application_Form_Metadata();
        		$data = array('personMeta' => $personMeta);
                $subform->setDefaults($data);
                $metadata->addSubForm($subform, (string) $personMeta->getId());
                unset($defaults[$key]);
            }
        }

        return parent::setDefaults($defaults);
    }


}

