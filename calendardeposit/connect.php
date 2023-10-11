<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=sleepy_database;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
