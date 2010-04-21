<?php
class Application_Model_DbTable_Person extends Zend_Db_Table_Abstract
{
    /**
     * Table Name
     */
    protected $_name = 'Person';
    
    /**
     * Primary Key
     */
    protected $_primary = 'Id'; 
}