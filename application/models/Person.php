<?php

class Application_Model_Person
{
	protected $_id;
    protected $_firstName;
    protected $_lastName;
    
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value)
    {
    	$method = 'set' . $name;
    	$method = str_replace('_', '', $method);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Person property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        $method = str_replace('_', '', $method);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Person property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
        	$method = 'set' . ucfirst($key);
        	$method = str_replace('_', '', $method);
        	
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
	public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
   	public function setFirstName($firstName)
   	{
   		$this->_firstName = (string) $firstName;
   		return $this;
   	}
    
    public function getFirstName() 
    {
    	return $this->_firstName;
    }
    
	public function setLastName($lastName)
   	{
   		$this->_lastName = (string) $lastName;
   		return $this;
   	}
    
    public function getLastName() 
    {
    	return $this->_lastName;
    }
}