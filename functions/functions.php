<?php


/*function to truncate strings to a suitable length for display - all parameters are passed as arguments enabling it to be easily adjusted depending on font characteristics	*/
function truncate($string, $length, $dots = "...") {
return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}	

function fetchFeaturedproperties($pdo){

// prepare the SQL statement
	// Amended because no sale properties in test feed
	$statement = $pdo->prepare('select ID, AGENT_REF, PRICE, DISPLAY_ADDRESS, MEDIA_IMAGE_00 FROM properties where TRANS_TYPE_ID = 1 order by UPDATE_DATE desc limit 6');
	//$statement = $pdo->prepare('select ID, AGENT_REF, PRICE, DISPLAY_ADDRESS, MEDIA_IMAGE_00 FROM properties where TRANS_TYPE_ID = 2 order by UPDATE_DATE desc limit 6');
//execute it 
	$statement->execute();
//and return the results to a class
	return $statement->fetchALL(PDO::FETCH_CLASS, 'Property');

}

function fetchSearchResults($pdo,$offset){

$sql = 'SELECT * FROM properties WHERE (PRICE BETWEEN ' . $_SESSION["q_pricemin"] . ' and ' . $_SESSION["q_pricemax"] . ') and (BEDROOMS between ' . $_SESSION["q_bedsmin"] . ' and ' . $_SESSION["q_bedsmax"] . ')  and TRANS_TYPE_ID = 1'; 

$_SESSION["rec_count"] = countAll($sql);
	
$statement = $pdo->prepare('select ID, AGENT_REF, PRICE, DISPLAY_ADDRESS, MEDIA_IMAGE_00, ID FROM properties where (PRICE BETWEEN ' . $_SESSION["q_pricemin"] . ' and ' .  $_SESSION["q_pricemax"] . ') and (BEDROOMS between ' . $_SESSION["q_bedsmin"] . ' and ' . $_SESSION["q_bedsmax"] . ') and TRANS_TYPE_ID = 1 order by PRICE asc LIMIT 10 OFFSET ' . $offset . '');

//$statement = $pdo->prepare('select AGENT_REF, PRICE, DISPLAY_ADDRESS, MEDIA_IMAGE_00 FROM properties order by PRICE desc limit 8');	
//execute it 
	$statement->execute();
	
	
//and return the results to a class
	return $statement->fetchALL(PDO::FETCH_CLASS, 'Property');

}

function fetchRentals($pdo,$offset){

$sql = 'SELECT AGENT_REF FROM properties WHERE TRANS_TYPE_ID = 2 order by PRICE asc'; 
$_SESSION["rec_count"] = countAll($sql);
$statement = $pdo->prepare('select AGENT_REF, PRICE, DISPLAY_ADDRESS, MEDIA_IMAGE_00, ID FROM properties where TRANS_TYPE_ID = 2 order by PRICE asc LIMIT 10 OFFSET ' . $offset . '');
	$statement->execute();
	
	
//and return the results to a class
	return $statement->fetchALL(PDO::FETCH_CLASS, 'Property');

}


function fetchDetails($pdo,$id){
	
	
$sql = 'select * FROM properties where ID = ' . $id . '';
// echo "sql statement is " . $sql;	

// prepare the SQL statement
	$statement = $pdo->prepare('select DISPLAY_ADDRESS, PRICE, BEDROOMS, LIVING_ROOMS, BATHROOMS, DESCRIPTION, MEDIA_IMAGE_00  FROM properties where ID = ' . $id . '');
//execute it 
	$statement->execute();
//and return the results to a class
	return $statement->fetchALL(PDO::FETCH_CLASS, 'Property');

}

function countAll($querystring){
   $db = ConnecttoDb();
   //$sql = "select * from `$table`";

   $stmt = $db->prepare($querystring);
    try { $stmt->execute();}
    catch(PDOException $e){echo $e->getMessage();}

return $stmt->rowCount();

}

function formatCurrency($value){
	
	return number_format((float)($value));
		
}


function getFeatures($pdo,$id){
	//$sql = 'select FEATURE1, FEATURE2, FEATURE3, FEATURE4, FEATURE5 from properties WHERE ID = ' . $id . '';
	

	// pass the SQL statement
	$statement = $pdo->prepare('SELECT `FEATURE1`,`FEATURE2`,`FEATURE3`,`FEATURE4`,`FEATURE5`, `FEATURE6`, `FEATURE7`, `FEATURE8`, `FEATURE9`,`FEATURE10` FROM `properties` WHERE `ID`  = ' . $id . '');
//execute it 
	$statement->execute();
//and return the results 
	$features = $statement->fetch(PDO::FETCH_ASSOC);
	return $features;
	
}
	
	
function getThumbs($pdo,$id){
	//$sql = 'select FEATURE1, FEATURE2, FEATURE3, FEATURE4, FEATURE5 from properties WHERE ID = ' . $id . '';
	

	// pass the SQL statement
	$statement = $pdo->prepare('SELECT `MEDIA_IMAGE_00`,`MEDIA_IMAGE_01`,`MEDIA_IMAGE_02`,`MEDIA_IMAGE_03`,`MEDIA_IMAGE_04`,`MEDIA_IMAGE_05`,`MEDIA_IMAGE_06`,`MEDIA_IMAGE_07`,`MEDIA_IMAGE_08`,`MEDIA_IMAGE_09` FROM `properties` WHERE `ID` = ' . $id . '');
//execute it 
	$statement->execute();
//and return the results 
	$thumbs = $statement->fetch(PDO::FETCH_ASSOC);
	return $thumbs;	
		
}

function imageToshow($imgname){
if ($imgname == ''){
		$filename = "noimage.png";
}	
	
elseif (file_exists("data/images/$imgname")){
	 $filename = $imgname;
	//echo 'triggered by if - filename is ' . $fileName;
}

else{
	$filename = "noimage.png";
	//echo 'triggered by else - filename is ' . $fileName;
    
}
	return $filename;
}

