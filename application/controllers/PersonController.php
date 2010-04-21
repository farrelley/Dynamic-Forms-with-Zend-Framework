<?php

class PersonController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
   		//index action	
	}

    public function addAction()
    {
 		$request = $this->getRequest();
        $form = new Application_Form_Person();
        $form->setAction('/person/add')
        	->setMethod('post');

		if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {
            	$formValues = $form->getValues();
            	Zend_Debug::dump($formValues);
            	/*
                $personMdl = new Application_Model_Person($formValues);
                $personMapper = new Application_Model_Mapper_Person();
                $id = $personMapper->insert($personMdl);
                return $this->_helper->redirector('index', 'person', 'default');
                */
			}
		}
        $this->view->form = $form;
    }

    public function updateAction()
    {
		if ('' === ($id = $this->_request->getParam('id', ''))) {
    		return $this->_helper->redirector('index', 'person', 'default'); 
    	}
    	
    	$personMdl = new Application_Model_Person();
    	$personMapper = new Application_Model_Mapper_Person();
    	$personMapper->find($id, $personMdl);
    	
    	$personMetaMdl = new Application_Model_PersonMetadata();
    	$personMetaMapper = new Application_Model_Mapper_PersonMetadata();
    	$metadata = $personMetaMapper->fetchMetadataByPersonId($personMdl->getId());
    	
    	$request = $this->getRequest();
        $form = new Application_Form_Person();
        $form->setDefaults($metadata);
        
        $form->getElement('firstName')->setValue($personMdl->getFirstName());
        $form->getElement('lastName')->setValue($personMdl->getLastName());
        $form->getElement('submit')->setLabel('Edit');
        
        $form->setAction('/person/update/id/' . $id)
        	->setMethod('post');

       	if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {
        		$formValues = $form->getValues();
        		$personMdl->setOptions($formValues);
            	$personMapper->save($personMdl);
            	Zend_Debug::dump($formValues);
            	//return $this->_helper->redirector('index', 'person', 'default'); 
        	}
        }
        $this->view->form = $form;
    }
    
    public function addanotherkeyvalueAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	$form = new Application_Form_Person();
    	$form->addme();
    	return;
    }

}





