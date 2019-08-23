<?php


function ConnecttoDb(){

try{
	// connection string for PDO data handling
	return new PDO('mysql:host=127.0.0.1;dbname=update','kiosk', 't1m3m3d1a');

//exception handling
} catch (PDOException $e) {

	// dies and returns error message
	die($e->getMessage());

	}

}