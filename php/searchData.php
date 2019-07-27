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
  $data 	 	 = isset($_POST['checkedData']) ? $_POST['checkedData'] : "" ;
  $longitude 	 = isset($_POST['longitude'])?$_POST['longitude']: "";
  $lattitude 	 = isset($_POST['lattitude'])?$_POST['lattitude']: "";
  $month 	 	 = isset($_POST['month'])?$_POST['month']: "";
  $reportedBy 	 = isset($_POST['reportedBy'])?$_POST['reportedBy']: "";
  $fallsWithin 	 = isset($_POST['fallsWithin'])?$_POST['fallsWithin']: "";
  $location 	 = isset($_POST['location'])?$_POST['location']: "";
  $LSOACode 	 = isset($_POST['LSOACode'])?$_POST['LSOACode']: "";
  $LSOAName 	 = isset($_POST['LSOAName']) ? $_POST['LSOAName'] : "" ;
  $crimeType 	 = isset($_POST['crimeType'])?$_POST['crimeType']: "";
  $lastOutcome 	 = isset($_POST['lastOutcome'])?$_POST['lastOutcome']: "";
  $aggType 	 	 = isset($_POST['aggType'])?$_POST['aggType']: "";
  $columnOption  = isset($_POST['columnOption'])?$_POST['columnOption']: "";
  $columnOption2 = isset($_POST['columnOption2'])?$_POST['columnOption2']: "";
  $sortType 	 = isset($_POST['sortType'])?$_POST['sortType']: "";
  $limit 	 	 = isset($_POST['limit'])?$_POST['limit']: "";
  $filter= [];

if(!empty($longitude))
{$filter["Longitude"]=$longitude;}
if(!empty($lattitude))
{$filter["Latitude"]=$lattitude;}
if(!empty($month))
{$filter["Month"]=$month;}
if(!empty($reportedBy))
{$filter["Reported by"]=$reportedBy;}
if(!empty($fallsWithin))
{$filter["Falls within"]=$fallsWithin;}
if(!empty($location))
{$filter["Location"]=$location;}
if(!empty($LSOACode))
{$filter["LSOA code"]=$LSOACode;}
if(!empty($LSOAName) ) {
	$filter['LSOA name'] = new MongoDB\ BSON\ Regex($LSOAName[0]);
}

if(!empty($crimeType))
{$filter["Crime type"]=$crimeType;}
if(!empty($lastOutcome))
{$filter["Last outcome category"]=$lastOutcome;}

  
	$column=[];
	$x =[];
	$y =[];
	$options = [];
	$d="<tr>";
	$export = "<table border='1' align='center' id='tabledata'>
		  <tr>";
	foreach($data as $dt)
	{
		$export .= "<td style='font-weight:bold'>".$dt."</td>";
	}
	$export .= "</tr>";
	
	
	
	
	if(!empty($aggType) &&  !empty($columnOption))
	{
		$command = new MongoDB\Driver\Command([
		'group' => [
         'ns' => 'Crime',
         '$reduce' => new MongoDB\BSON\JavaScript('function(doc, prev){prev.count += 1}'),
         'key' => [ $columnOption => true ],
         'cond' => $filter,
         'initial' => [ 'count' => 0 ],
			],
		  ]);
		$rows = $m->executeCommand('WestCrime', $command)->toArray();
		
		if (count($rows)>0){
		foreach ($rows as $document) {	
		
		$document = json_decode(json_encode($document),true);
	
			foreach($document['retval'] as $dt)
			{
				$x =  $dt['count'];
				$y = $dt[$columnOption];
				
				array_push($column,[$dt['count'],$dt[$columnOption]]);
				
						
			}
			
			
		}
		if($aggType == "top")
		{
			arsort($column);
			}
			else
			{
			asort($column);
		}
		//echo print_r($column);
		$export="<table border='1' align='center' id='tabledata'><tr><td>Variable</td><td>Count</td></tr>";
			foreach($column as $c)
			{
				$d.="<tr><td>".$c[1]."</td><td>".$c[0]."</td></tr>";
			}
		
		$finalData = $export."".$d."</table>";
		echo $finalData;
		}
		else echo 'No Data Available';
	}
	else {
		if(!empty($sortType) && !empty($columnOption2))
		{ if($sortType == "asc")
			{$options['sort'][$columnOption2]=1;}
		  else
		  { $options['sort'][$columnOption2]=-1;}
		}
		if(!empty($limit))
		{
			$options['limit']=$limit;
		}
				
		if(!empty($LSOAName) && !is_null($LSOAName) && isset($LSOAName))
			{
				foreach($LSOAName as $val1)
				{
					$val1 = "^".$val1."";
				//echo $val1;	
				$regex = new MongoDB\BSON\Regex ($val1);
				$filter["LSOA name"]=$regex;		
				$query = new \MongoDB\Driver\Query($filter, $options);
				
				$rows   = $m->executeQuery('WestCrime.Crime', $query)->toArray();
						
				$dt = "";
				if (count($rows)>0){
				foreach ($rows as $r => $document) {	
				
				$document = json_decode(json_encode($document),true);
				 
					foreach($data as $dt => $val)
						{
							if ($val == "Crime ID")
							{
								$d.="<td>".substr($document[$val],0,5)."... </td>";
							}
							else {
								$d.="<td>".$document[$val]."</td>";
							}
						}$d.="</tr>";
					}
				}}
				$finalData = $export."".$d."</table>";
				echo $finalData;
			}

			
			else 
			{


				echo '<script language="javascript">';
echo 'alert("You must select a field")';
echo '</script>';

				
			}

			
			
				
	}
	
?>	