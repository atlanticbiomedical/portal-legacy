<?php

/**
 * unprocessed actions.
 *
 * @package    atlbiomed
 * @subpackage unprocessed
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class unprocessedActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  { 

    
  	
    $connection = Propel::getConnection();
    $query = "select DISTINCT filename FROM unprocessed_devices";
	$statement = $connection->prepareStatement($query);
	$result = $statement->executeQuery();

	while($result->next()){
            $n = $result->get('filename');
            $file_p = $_SERVER['DOCUMENT_ROOT'].'/uploads/spreadsheet/'.$n;
            
            if(file_exists($file_p)){
			    $filenames[] = $n;
            }else{
                $filename_not_found[] = $file_p;
            }
    }//while
    $this->filenamesList = $filenames;
    
    $processFilename = $this->getRequestParameter('fn');

    if(!empty($processFilename)){
 
	    $this->filenames = $filenames; 
	    $processHandler = new processHandler();
	    $processHandler->loadFile($processFilename);
	    
	    $c = new Criteria();
	  	$c->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION);
	  	$clients = ClientPeer::doSelect($c);
	  	
	    $this->partialMatch = $processHandler->getPartialMatch();
	  	$this->noMatch = $processHandler->getNoMatch();
	  	$this->match = $processHandler->getMatched(); 
	  	$this->clients = $clients;
	  	$this->filename = $processHandler->getFilename();
    }//if
  }//function
}
