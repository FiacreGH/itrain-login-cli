<?php
/**
 * Ceci est un crip php qui permet à un user de s'authentifier en CLI
 */

include('Classes/Database.php');
include('Classes/Logger.php');
//connexion à la bd
$authentificate = new Ecodev\Database('localhost', 'root', 'root');
$authentificate->connect('authentificate');
$logger = new Logger();
for ($i = 1; $i <= 3; $i++) {
	$logger->log('Bonjour, qui êtes-vous?');
	# @todo renommer la variable username
	$usr = trim(fgets(STDIN));
	$logger->log('Et votre passe?');
	# @todo renommer la variable password
	$pass = trim(fgets(STDIN));
	# @todo remplacer avec qq chose du genre
	# On ne veut pas des $users mais un $user
	# $user = $database->selectOne('SELECT * FROM user where username= $username AND password = $password');
	$users = $authentificate->select('SELECT * FROM user where id= 1');
	
	# @todo test si la variable $user existe => l'utilisteur est loggué si non l'utilisateur ne l'est pas
	# @todo delete
	$u = 'username';
	$p = 'passwd';
	foreach ($users as $user) {
		$username = $user[$u];
		$passwd = $user[$p];
		if ($usr == $username && $pass == $passwd) {
			$logger->log('Ok, welcome vous êtes dedans!!!');
			exit();
		}
	}
	$logger->log('ERREUR,' . $i . 'ème essaie!!!');
}
$logger->log('Non, vous restez dehors!!!');
