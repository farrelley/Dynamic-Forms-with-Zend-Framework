<?php 

class Application_Model_Mapper_PersonMetadata
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
            $this->setDbTable('Application_Model_DbTable_PersonMetadata');
        }
        return $this->_dbTable;
    }
 
    public function insert(Application_Model_PersonMetadata  $personMetadata)
    {
        $data = array(
        	'Person_Id' => $personMetadata->getPersonId(),
        	'Key' => $personMetadata->getKey(),
			'Value' => $personMetadata->getValue(),
        );
 		$this->getDbTable()->insert($data);
    }
    
    public function delete($id)
    {
    	$this->getDbTable()->delete()->where('Person_Id = ?', $id);
    }
        
    public function fetchMetadataByPersonId($personId)
    {
    	$select = $this->getDbTable()->select()->where('Person_Id = ?', $personId);
        $resultSet = $this->getDbTable()->fetchAll($select);
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_PersonMetadata();
            $entry->setId($row->Id)
        		->setPersonId($row->Person_Id)
        		->setKey($row->Key)
        		->setValue($row->Value);
            $entries[] = $entry;
        }
        return $entries;
    }
}