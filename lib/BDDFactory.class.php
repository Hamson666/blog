<?php
class BDDFactory {
	public static function getMysqlConnexion() {
		$bdd = new PDO('mysql:host=zash.sql-pro.online.net;dbname=zash', 'zash', 'franco981', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
		return $bdd;
	}
}
?>