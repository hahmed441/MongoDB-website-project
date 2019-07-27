<?php
  function createConnection(){ 
    $m = new MongoDB\Driver\Manager("mongodb://localhost:27017"); 
	return $m;
  }
?>