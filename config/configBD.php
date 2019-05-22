<?php

function conn_mysql(){

    $servername = 'localhost';
    $porta = 3306;
    $username = 'root';
    $password = '';
    $database = 'belair';
    
    $conn = new PDO("mysql:host=$servername;
	                   port=$porta;
					   dbname=$database", 
					   $username, 
					   $password,
					   array(PDO::ATTR_PERSISTENT => true)
					   );
    
    return $conn;

}

?>