<?php
	try{
		$db = new PDO("mysql:dbname=sgta; host=localhost; charset=utf8", "root","");
	}catch(PDOException $e){
		echo $e->getMessage();
	}

?>

