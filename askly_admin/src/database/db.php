<?php 
    define('HOST_PANEL', 'localhost');
    define('DB_NAME_PANEL', '*');
    define('USER_PANEL', '*');
    define('PASS_PANEL', '*');

    try{
 		$db = new PDO("mysql:host=" . HOST_PANEL . ";dbname=" . DB_NAME_PANEL, USER_PANEL, PASS_PANEL);
 		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   	} catch(PDOException $e){
   		echo "Erreur : ". $e->getMessage();
   	}