<html>
<head>
	<link rel="stylesheet" type="text/css" href="tableCss.css">

<style type="text/css">
#tabledata {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  background-color: white;

}

#tabledata td, #tabledata th {
  border: 2px solid #c9c5c5;
  padding: 8px;

}



#tabledata tr:nth-child(even){background-color: #f2f2f2;}

#tabledata tr:hover {background-color: #000000; color:white;}

#tabledata th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}


</style>
</head>
</html>
<?php
  include 'mongoConnnect.php';
  $m = createConnection();
  $filter= [];
	$options = [];
	$d="";
	$query = new \MongoDB\Driver\Query($filter, $options);
	$data = "<table id='tabledata'}>
		  <tr>
			<td style='font-weight:bold'>Crime ID</td>
			<td style='font-weight:bold'>Month</td>
			<td style='font-weight:bold'>Reported By</td>
			<td style='font-weight:bold'>Falls within</td>
			<td style='font-weight:bold'>Longitude</td>
			<td style='font-weight:bold'>Latitude</td>
			<td style='font-weight:bold'>Location</td>
			<td style='font-weight:bold'>LSOA Code</td>
			<td style='font-weight:bold'>LSOA Name</td>
			<td style='font-weight:bold'>Crime type</td>
			<td style='font-weight:bold'>Last Outcome Category</td>
		  </tr>";
	$rows   = $m->executeQuery('WestCrime.Crime', $query)->toArray();
	if (count($rows)>0){
	foreach ($rows as $document) {		
	$document = json_decode(json_encode($document),true);
		
	$d.=	  "<tr>
			<td>".substr($document['Crime ID'],0,5)."... </td>
			<td>".$document['Month'].
			"<td>".$document['Reported by']."</td>
			<td>".$document['Falls within'].
			"<td>".$document['Longitude']."</td>
			<td>".$document['Latitude'].
			"<td>".$document['Location']."</td>
			<td>".$document['LSOA code'].
			"<td>".$document['LSOA name']."</td>
			<td>".$document['Crime type'].
			"<td>".$document['Last outcome category']."</tr>";	     
	}
	$finalData = $data."".$d."</table>";
	echo $finalData;
	}
	else echo 'No Data Available';
?>
</body>
</html>