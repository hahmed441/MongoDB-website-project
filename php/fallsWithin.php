<?php
  include 'mongoConnnect.php';
  $m = createConnection();
  $d = "<select>";
  $id =1;
  $filter= [];
  $options = [];
	$query = null;
	$cmd = new \MongoDB\Driver\Command([
	'distinct' => 'Crime', 
    'key' => 'Falls within',
	'query' => $query]);
	$rows = $m->executeCommand('WestCrime', $cmd);
	foreach ($rows as $key => $document) {		
	$document = json_decode(json_encode($document),true);
	sort($document["values"]);
		foreach ($document["values"] as $doc) {	
		$d.=  "<option value='".$doc."'>".$doc."</option>";
		}
	}
    echo $d."</select>";
?>