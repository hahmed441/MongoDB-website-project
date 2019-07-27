<?php
  include 'mongoConnnect.php';
  $m = createConnection();
  $d = "<select multiple id='lsoan'>";
  $id =1;
  $filter= [];
  $options = [];
  $value = [];
  $arr = [];
  $prev ="";
	$query = null;
	$cmd = new \MongoDB\Driver\Command([
	'distinct' => 'Crime', 
    'key' => 'LSOA name',
	'query' => $query]);
	$rows = $m->executeCommand('WestCrime', $cmd);
	foreach ($rows as $key => $document) {		
	$document = json_decode(json_encode($document),true);
	sort($document["values"]);
		foreach ($document["values"] as $doc) {	
		$arr = explode(' ',trim($doc));
		if ($arr[0] != $prev)
		{
		array_push($value,$arr[0]);
		}
		
		$prev=$arr[0];
		}
		foreach ($value as $v) {
			$d.=  "<option value='".$v."'>".$v."</option>";
		}
		
	}

    echo $d."</select>";

?>