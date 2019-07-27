<?php
  include 'mongoConnnect.php';
  $m = createConnection();
  $d = "<select><option></option>";
  $id =1;
  $filter= [];
  $options = [];
	$query = null;
	$cmd = new \MongoDB\Driver\Command([
	'distinct' => 'Column', 
    'key' => 'Name',
	'query' => $query]);
	$rows = $m->executeCommand('WestCrime', $cmd);
	foreach ($rows as $key => $document) {		
	$document = json_decode(json_encode($document),true);
		foreach ($document["values"] as $doc) {	
		$d.=  "<option value='".$doc."'>".$doc."</option>";
		}
	}
    echo $d."</select>";
	
?>