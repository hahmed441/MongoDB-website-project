<?php
  include 'mongoConnnect.php';
  $m = createConnection();
  $d = "";
  $id =1;
  $filter= [];
  $options = [];
  $query = new \MongoDB\Driver\Query($filter, $options);  
  $rows   = $m->executeQuery('WestCrime.Column', $query)->toArray();
  
  if (count($rows)>0){
	foreach ($rows as $document) {		
	$document = json_decode(json_encode($document),true);
		
	$d.= "<input type='checkbox' name='column' value='".$document['Name']."' id='column_".$id."' checked />".$document['Name']."
                <br />";	
	$id = $id + 1;
	}
	echo $d;
	}
	else echo 'No Data';
?>	