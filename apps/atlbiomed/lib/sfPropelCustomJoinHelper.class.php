<?php 

class sfPropelCustomJoinObjectProxy
{
  protected
    $customJoin, 
    $className,
    $obj,
    
    $extObjs;

  public function __construct($customJoin, $className)
  {
    $this->customJoin = $customJoin;
    $this->className = $className;
    $this->obj = new $className;

    $this->extObjs = array();
  }

  public function getDataObject()
  {
    return $this->obj;
  }

  public function isAllPrimaryKeyNull()
  {
    $pks = $this->obj->getPrimaryKey();
    foreach ((array)$pks as $pk)
      if ($pk)
        return false;
    return true;
  }

  public function __call($name, $args)
  {
    if (preg_match('/^get(.*)$/', $name, $matches))
    {
      if (array_key_exists($matches[1], $this->extObjs))
        return $this->extObjs[$matches[1]];
    }
    return call_user_func_array(array($this->obj, $name), $args);
  }

  public function hydrate(ResultSet $rs, $startcol = 1)
  {
     $startcol = $this->obj->hydrate($rs, $startcol);
     return $startcol;
  }

  public function addExternalObject($obj, $alias=false)
  {
    $key = $alias?$alias:get_class($obj->getDataObject());
    $this->extObjs[$key] = $obj;
  }
}

class sfPropelCustomJoinHelper
{
  protected
    $mainClassName = '',
    $selectClasses,
    $classOwnership;

  public function __construct($mainClassName)
  {
    $this->mainClassName = $mainClassName;
    $this->selectClasses = array();
    $this->classOwnership = array();
  }

  public function addSelectTables()
  {
    $classes = array();
    if (func_num_args() == 1)
      $classes = (array)func_get_arg(0);
    else
      $classes = func_get_args();
    $this->selectClasses = array_merge($this->selectClasses, $classes);
  }

  public function clearSelectClasses()
  {
    $this->selectClasses = array();
  }

  public function hydrate($rs, $startCol=1)
  {
    $obj = new sfPropelCustomJoinObjectProxy($this, $this->mainClassName);
    $startCol = $obj->hydrate($rs, 1);

    $childObjs = array();
  
    foreach ($this->selectClasses as $className)
    {
      $childObj = new sfPropelCustomJoinObjectProxy($this, $className);
      $startCol = $childObj->hydrate($rs, $startCol);
      if ($childObj->isAllPrimaryKeyNull())
        $childObjs[$className] = null;
      else
        $childObjs[$className] = $childObj;
    }

    foreach ($childObjs as $childClassName => $childObj)
    {
      $obj->addExternalObject($childObj, $childClassName); //main class object always holds all child objects.
      if (isset($this->classOwnership[$childClassName]))
        foreach ($this->classOwnership[$childClassName] as $tmp)
          if (array_key_exists($tmp[0], $childObjs))
            $childObj->addExternalObject($childObjs[$tmp[0]], $tmp[1]);
    }
    return $obj;
  }
  
  public function doCount($c, $con=null)
  {
    return call_user_func_array(array($this->mainClassName.'Peer', 'doCount'), array($c, $con));
  }

  public function doSelect($c, $con=null)
  {
    $rs = $this->doSelectRS($c, $con=null);

    $a = array();
    while ($rs->next())
      $a[] = $this->hydrate($rs);
    return $a;
  }

	public function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = $this->doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}


  /**
   * Return the Propel ResultSet object.
   *
   * This method adds all columns specified with addSelectTables method.
   * @see addSelectTables
   */
  public function doSelectRS($criteria, $con=null)
  {
    $c = clone $criteria;
    $c->clearSelectColumns();

    call_user_func(array($this->mainClassName.'Peer', 'addSelectColumns'), $c);
    foreach ($this->selectClasses as $className)
      call_user_func(array($className.'Peer', 'addSelectColumns'), $c);
    $rs = call_user_func_array(array($this->mainClassName.'Peer', 'doSelectRS'), array($c, $con));
    return $rs;
  }

  public function setHas($className, $has, $alias=false)
  {
    if (!isset($this->classOwnership[$className]))
      $this->classOwnership[$className] = array();
    $alias = ($alias === false?$className:$alias);
    $this->classOwnership[$className][] = array($has, $alias);
  }

  /**
   * Do proxy call to peer method of the main class.
   */
  protected function __call($name, $args)
  {
    return call_user_func_array(array($this->mainClassName.'Peer', $name), $args);
  }

  /**
   * Return the main class name. This is to work around when the pager object
   * tries to include the Peer class file.
   */
  public function __toString()
  {
    return $this->mainClassName;
  }
}
