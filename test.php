<?php 
header("Access-Control-Allow-Origin: *");
require_once("./../connection.php");
	  //http://geojson.io/#map=11/13.6150/-88.2339
	  //https://wtools.io/convert-json-to-php-array
	  # conectare la base de datos
	//   $db_host="localhost";
	//   $db_user="root";
	//   $db_pass="";
	//   $db_name="test_marcadores";
   // $con=@mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$sql="SELECT * FROM pish_phocamaps_marker_store";
	$query=$conn->query($sql);
	$features = [];
	$i=0;

	while($row=mysqli_fetch_array($query)){
		//if(isset($row[$query])){
		//if ($row['latitude']!= null && $row['longitude']!=null && $row['phone']!=null && $row['ShopName']!=null ){
		$lat=$row['latitude'];
	    $long=$row['longitude'];
		$propiedades1=array ('title'=> $row['ShopName'],'description'=> $row['phone']);
		$arreglo_datos=array ('type' => 'Feature','properties' => $propiedades1,'geometry' =>  array ('type' => 'Point','coordinates' => array (0 => $long,1 => $lat)));
        $features += ["$i" =>$arreglo_datos ];
		$i++;
	

//	}else{
		//return null;
//	}
}

	

$array_multi=$features;
$data=
array ('type' => 'FeatureCollection','features' => $features);

