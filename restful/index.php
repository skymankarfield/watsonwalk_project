<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('debug'=>true));

$app->get('/hello', function ()
{
	$request = \Slim\Slim::getInstance()->request();
    #$gameObject = json_decode($request->getBody());
    try {
        $db = getConnection();
        #include 'faars/misc/notifyExternalSystem.php';
		$arrayResponse = array();
		#notifyExternalSystem($gameObject,$arrayResponse);
		#echo json_encode($arrayResponse);
		echo "Works!";
    }catch(PDOException $e){
    	$arrayResponse = array();
		$arrayResponse["status"] = 1;
		$arrayResponse["message"] = $e->getMessage();
        echo "It doesn't work...";
        #echo json_encode($arrayResponse);
    }

});


$app->run();

function getConnection() {
    $dbhost="localhost";
    $dbuser="parisapp";
    $dbpass="appparis102938";
    $dbname="locationBasedApp";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


?>
