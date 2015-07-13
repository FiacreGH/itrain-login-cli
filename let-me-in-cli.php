<?php
/**
 * Ceci est un crip php qui permet à un user de s'authentifier en CLI
 */
include('Classes/Database.php');
include('Classes/Logger.php');
//connexion à la bd
$database = new Ecodev\Database('localhost', 'root', 'root');
$database->connect('authentificate');
$logger = new Logger();
$isAuthenticated = FALSE;
$logger->log('Bonjour, qui êtes-vous?');
$username = trim(fgets(STDIN));
$logger->log('Et votre passe?');
$password = trim(fgets(STDIN));
$hachedPassword = md5($password);
$user = $database->selectOne('SELECT * FROM user where username = "' . $username . '" AND passwd = "' . $hachedPassword . '"LIMIT 1 ');
if (!empty($user)) {
	$logger->log('Ok, welcome vous êtes dedans!!!');
	//$isAuthenticated = TRUE;
	exit();
}
$logger->log('Non, vous restez dehors!!!');

/**
 * La variante qui propose 3 essaies ;)
 */
include('Classes/Database.php');
include('Classes/Logger.php');
//connexion à la bd
$database = new Ecodev\Database('localhost', 'root', 'root');
$database->connect('authentificate');
$logger = new Logger();
$isAuthenticated= FALSE;
for ($i = 1; $i <= 3 /* ||$isAuthenticated */; $i++) {
	$logger->log('Bonjour, qui êtes-vous?');
	$username = trim(fgets(STDIN));
	$logger->log('Et votre passe?');
	$password = trim(fgets(STDIN));
	$hachedPassword = md5($password);
	$user = $database->selectOne('SELECT * FROM user where username = "' . $username . '" AND passwd = "' . $hachedPassword.'"LIMIT 1 ');
	if (!empty($user)){
		$logger->log('Ok, welcome vous êtes dedans!!!');
		//$isAuthenticated = TRUE;
		exit();
	}
	$logger->log('ERREUR,' . $i .'ème essaie!!!');
}
$logger->log('Non, vous restez dehors!!!');

