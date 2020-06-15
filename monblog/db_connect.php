<?php
try //Connexion à la bdd
{
	$db = NEW PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} 
                
catch (Exception $e)
{
	die('Erreur de connexion à la base de données :' .$e->getMessage());
}