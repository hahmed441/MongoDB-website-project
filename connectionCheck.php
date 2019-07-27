<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MongoDb Connection Check</title>
</head>
<body>
<?php
	
   // connect to mongodb
   //$m = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	//var_dump($m);
   //echo "Connection to database successfully";
	
   // connect to mongodb
   $m = new MongoDB\Driver\Manager("mongodb://localhost:27017");
   var_dump($m);
   echo "</br>Connection to database successfully";
	
   
	$filter      = ['shloka_code' => 2.3];
	$options = [];

	$query = new \MongoDB\Driver\Query($filter, $options);
	$rows   = $m->executeQuery('WestCrime.Crime', $query); 

	foreach ($rows as $document) {
	$document = json_decode(json_encode($document),true);
    echo $document['quote'];
}
?>
</body>
</html>