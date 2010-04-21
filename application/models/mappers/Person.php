<?php 

class Application_Model_Mapper_Person
{
    protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Person');
        }
        return $this->_dbTable;
    }
 
    public function insert(Application_Model_Person $person)
    {
        $data = array(
        	'First_Name' => $person->getFirstName(),
			'Last_Name' => $person->getLastName(),
        );
 		$this->getDbTable()->insert($data);
    }
    
    public function save(Application_Model_Person $person) 
    {
		$data = array(
        	'First_Name' => $person->getFirstName(),
			'Last_Name' => $person->getLastName(),
		);
        $this->getDbTable()->update($data, array('Id = ?' => $person->getId()));
    }
    
    public function find($id, Application_Model_Person $person)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $person->setId($row->Id)
        	->setFirstName($row->First_Name)
        	->setLastName($row->Last_Name);
    }
}