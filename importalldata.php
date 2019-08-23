
<?php 

require 'functions/functions.php';
require 'functions/database.php';
require 'functions/phpblm.php';
require 'functions/config.php';


// Create connection
$con = ConnecttoDb();

//Clear old data
try {
    
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = 'DELETE FROM properties';

    // use exec() because no results are returned
    $con->exec($sql);
    echo "Records deleted successfully<br>";
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    
// Create the array to be imported	
$blm = new phpblm("NEWDATA.BLM");
	
$ready = '';
$fail = '';
 

$sql = "INSERT INTO properties (
		AGENT_REF,
		TOWN,
		FEATURE1,
		FEATURE2,
		FEATURE3,
		FEATURE4,
		FEATURE5,
		FEATURE6,
		FEATURE7,
		FEATURE8,
		FEATURE9,
		FEATURE10,
		SUMMARY,
		DESCRIPTION,
		BRANCH_ID,
		STATUS_ID,
		BEDROOMS,
		BATHROOMS,
		LIVING_ROOMS,
		PRICE,
		PRICE_QUALIFIER,
		PROP_SUB_ID,
		CREATE_DATE,
		UPDATE_DATE,
		DISPLAY_ADDRESS,
		LET_DATE_AVAILABLE,
		LET_TYPE_ID,
		LET_FURN_ID,
		LET_RENT_FREQUENCY,
		TRANS_TYPE_ID,
		MEDIA_IMAGE_00, 
		MEDIA_IMAGE_01,
		MEDIA_IMAGE_02, 
		MEDIA_IMAGE_03, 
		MEDIA_IMAGE_04, 
		MEDIA_IMAGE_05,
		MEDIA_IMAGE_06, 
		MEDIA_IMAGE_07, 
		MEDIA_IMAGE_08,
		MEDIA_IMAGE_09,
		MEDIA_DOCUMENT_00,
		MEDIA_DOCUMENT_50,
		MEDIA_DOCUMENT_TEXT_50
    )
    VALUES (
    	:AGENT_REF,
		:TOWN,
		:FEATURE1,
		:FEATURE2,
		:FEATURE3,
		:FEATURE4,
		:FEATURE5,
		:FEATURE6,
		:FEATURE7,
		:FEATURE8,
		:FEATURE9,
		:FEATURE10,
		:SUMMARY,
		:DESCRIPTION,
		:BRANCH_ID,
		:STATUS_ID,
		:BEDROOMS,
		:BATHROOMS,
		:LIVING_ROOMS,
		:PRICE,
		:PRICE_QUALIFIER,
		:PROP_SUB_ID,
		:CREATE_DATE,
		:UPDATE_DATE,
		:DISPLAY_ADDRESS,
		:LET_DATE_AVAILABLE,
		:LET_TYPE_ID,
		:LET_FURN_ID,
		:LET_RENT_FREQUENCY,
		:TRANS_TYPE_ID,
		:MEDIA_IMAGE_00, 
		:MEDIA_IMAGE_01,
		:MEDIA_IMAGE_02, 
		:MEDIA_IMAGE_03, 
		:MEDIA_IMAGE_04, 
		:MEDIA_IMAGE_05,
		:MEDIA_IMAGE_06, 
		:MEDIA_IMAGE_07, 
		:MEDIA_IMAGE_08,
		:MEDIA_IMAGE_09,
		:MEDIA_DOCUMENT_00,
		:MEDIA_DOCUMENT_50,
		:MEDIA_DOCUMENT_TEXT_50
		)
		ON DUPLICATE KEY UPDATE
		AGENT_REF = :AGENT_REF,
		TOWN = :TOWN,
		FEATURE1 = :FEATURE1,
		FEATURE2 = :FEATURE2,
		FEATURE3 = :FEATURE3,
		FEATURE4 = :FEATURE4,
		FEATURE5 = :FEATURE5,
		FEATURE6 = :FEATURE6,
		FEATURE7 = :FEATURE7,
		FEATURE8 = :FEATURE8,
		FEATURE9 = :FEATURE9,
		FEATURE10 = :FEATURE10,
		SUMMARY = :SUMMARY,
		DESCRIPTION = :DESCRIPTION,
		BRANCH_ID = :BRANCH_ID,
		STATUS_ID = :STATUS_ID,
		BEDROOMS = :BEDROOMS,
		BATHROOMS = :BATHROOMS,
		LIVING_ROOMS = :LIVING_ROOMS,
		PRICE = :PRICE,
		PRICE_QUALIFIER = :PRICE_QUALIFIER,
		PROP_SUB_ID = :PROP_SUB_ID,
		CREATE_DATE = :CREATE_DATE,
		UPDATE_DATE = :UPDATE_DATE,
		DISPLAY_ADDRESS = :DISPLAY_ADDRESS,
		LET_DATE_AVAILABLE = :LET_DATE_AVAILABLE,
		LET_TYPE_ID = :LET_TYPE_ID,
		LET_FURN_ID = :LET_FURN_ID,
		LET_RENT_FREQUENCY = :LET_RENT_FREQUENCY,
		TRANS_TYPE_ID = TRANS_TYPE_ID,
		MEDIA_IMAGE_00 = :MEDIA_IMAGE_00, 
		MEDIA_IMAGE_01 = :MEDIA_IMAGE_01,
		MEDIA_IMAGE_02 = :MEDIA_IMAGE_02, 
		MEDIA_IMAGE_03 = :MEDIA_IMAGE_03, 
		MEDIA_IMAGE_04 = :MEDIA_IMAGE_04, 
		MEDIA_IMAGE_05 = :MEDIA_IMAGE_05,
		MEDIA_IMAGE_06 = :MEDIA_IMAGE_06, 
		MEDIA_IMAGE_07 = :MEDIA_IMAGE_07, 
		MEDIA_IMAGE_08 = :MEDIA_IMAGE_08,
		MEDIA_IMAGE_09 = :MEDIA_IMAGE_09,
		MEDIA_DOCUMENT_00 = :MEDIA_DOCUMENT_00,
		MEDIA_DOCUMENT_50 = :MEDIA_DOCUMENT_50,
		MEDIA_DOCUMENT_TEXT_50 = :MEDIA_DOCUMENT_TEXT_50
		";	
	
$stmt = $con->prepare($sql) ;
 
// Check if prepare() failed.
if ( false === $stmt ) {
    echo 'prepare() failed: ' . htmlspecialchars($stmt->error);
    trigger_error($con->error, E_USER_ERROR);
}
 
// Start transaction 
$con->beginTransaction();
 
foreach ($blm->properties() as $properties) {
	$bind = array (
        ':AGENT_REF' => $properties['AGENT_REF'],
		':TOWN' => $properties['TOWN'],
		':FEATURE1' => $properties['FEATURE1'],
		':FEATURE2' => $properties['FEATURE2'],
		':FEATURE3' => $properties['FEATURE3'],
		':FEATURE4' => $properties['FEATURE4'],
		':FEATURE5' => $properties['FEATURE5'],
		':FEATURE6' => $properties['FEATURE6'],
		':FEATURE7' => $properties['FEATURE7'],
		':FEATURE8' => $properties['FEATURE8'],
		':FEATURE9' => $properties['FEATURE9'],
		':FEATURE10' => $properties['FEATURE10'],
		':SUMMARY' => $properties['SUMMARY'],
		':DESCRIPTION' => $properties['DESCRIPTION'],
		':BRANCH_ID' => $properties['BRANCH_ID'],
		':STATUS_ID' => $properties['STATUS_ID'],
		':BEDROOMS' => $properties['BEDROOMS'],
		':BATHROOMS' => $properties['BATHROOMS'],
		':LIVING_ROOMS' => $properties['LIVING_ROOMS'],
		':PRICE' => $properties['PRICE'],
		':PRICE_QUALIFIER' => $properties['PRICE_QUALIFIER'],
		':PROP_SUB_ID' => $properties['PROP_SUB_ID'],
		':CREATE_DATE' => $properties['CREATE_DATE'],
		':UPDATE_DATE' => $properties['UPDATE_DATE'],
		':DISPLAY_ADDRESS' => $properties['DISPLAY_ADDRESS'],
		':LET_DATE_AVAILABLE' => $properties['LET_DATE_AVAILABLE'],
		':LET_TYPE_ID' => $properties['LET_TYPE_ID'],
		':LET_FURN_ID' => $properties['LET_FURN_ID'],
		':LET_RENT_FREQUENCY' => $properties['LET_RENT_FREQUENCY'],
		':TRANS_TYPE_ID' => $properties['TRANS_TYPE_ID'],
		':MEDIA_IMAGE_00' => $properties['MEDIA_IMAGE_00'], 
		':MEDIA_IMAGE_01' => $properties['MEDIA_IMAGE_01'],
		':MEDIA_IMAGE_02' => $properties['MEDIA_IMAGE_02'], 
		':MEDIA_IMAGE_03' => $properties['MEDIA_IMAGE_03'], 
		':MEDIA_IMAGE_04' => $properties['MEDIA_IMAGE_04'], 
		':MEDIA_IMAGE_05' => $properties['MEDIA_IMAGE_05'],
		':MEDIA_IMAGE_06' => $properties['MEDIA_IMAGE_06'], 
		':MEDIA_IMAGE_07' =>  $properties['MEDIA_IMAGE_07'],
		':MEDIA_IMAGE_08' => $properties['MEDIA_IMAGE_08'],
		':MEDIA_IMAGE_09' => $properties['MEDIA_IMAGE_09'],
		':MEDIA_DOCUMENT_00' => $properties['MEDIA_DOCUMENT_00'],
		':MEDIA_DOCUMENT_50' => $properties['MEDIA_DOCUMENT_50'],
		':MEDIA_DOCUMENT_TEXT_50' => $properties['MEDIA_DOCUMENT_TEXT_50']);	
         
    // Check if bind_param() failed.
    if ( false === $bind ) {
        echo 'bind_param() failed: ' . htmlspecialchars($stmt->error);
    }
    
    //var_dump($bind);
 
    $exec = $stmt->execute($bind);
 
    // Check if execute() failed.
    if ( false === $exec ) {
        $fail .= sprintf("%s will not be inserted because execute() failed: %s<br />", $properties['AGENT_REF'], htmlspecialchars($stmt->error));
    } else {
        $ready .= sprintf("%s will be inserted in database.<br />", $properties['AGENT_REF']);
    }
 
}
 
 
if ( ! empty( $ready ) )
    echo $ready;
if ( ! empty( $fail ) )
    echo $fail;
 
// Commit the transaction
$commit = $con->commit();

 
if ( false === $commit ) {
    echo "Transaction commit failed<br />";
}
 
echo "<br />End of script.<br />";
 

	
