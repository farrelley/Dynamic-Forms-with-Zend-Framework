<?php

class Application_Model_PersonMetadata
{
	protected $_id;
	protected $_personId;
    protected $_key;
    protected $_value;
    
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
            throw new Exception('Invalid Person Metadata property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        $method = str_replace('_', '', $method);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Person Metadata property');
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
    
	public function setPersonId($id)
    {
        $this->_personId = (int) $id;
        return $this;
    }
 
    public function getPersonId()
    {
        return $this->_personId;
    }
    
   	public function setkey($key)
   	{
   		$this->_key = (string) $key;
   		return $this;
   	}
    
    public function getKey() 
    {
    	return $this->_key;
    }
    
	public function setValue($value)
   	{
   		$this->_value = (string) $value;
   		return $this;
   	}
    
    public function getValue() 
    {
    	return $this->_value;
    }
}