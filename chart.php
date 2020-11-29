<?php
header("Access-Control-Allow-Origin: *");
require_once("./../connection.php");
$conn = new mysqli($servername, $username, $password, $db_name);

$sql = " SELECT `Address`,`ShopName`,`phone`,`longitude`,`latitude` FROM `pish_phocamaps_marker_store` LIMIT 10 ";
$query = $conn->query($sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


mysqli_set_charset($conn, "utf8");

	$query=$conn->query($sql);
	$features = [];
	$i=0;

	while($row=mysqli_fetch_array($query)){
		//if(isset($row[$query])){
		//if ($row['latitude']!= null && $row['longitude']!=null && $row['phone']!=null && $row['ShopName']!=null ){
		$lat=$row['latitude'];
	    $long=$row['longitude'];
		$properties1=array ('title'=> $row['ShopName'],'description'=> $row['phone'] ,'address'=>  $row['Address']);
		$arr=array ('type' => 'Feature','properties' => $properties1,'geometry' => array ('type' => 'Point','coordinates' => array (0 => $long,1 => $lat)));
        $features += ["$i" =>$arr ];
		$i++;
	

//	}else{
		//return null;
//	}
}

	

$array_multi=$features;
$data=
array ('type' => 'FeatureCollection','features' => $features);
echo json_encode($data);

?>