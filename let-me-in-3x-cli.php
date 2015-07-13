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
	$usr = trim(fgets(STDIN));
	$logger->log('Et votre passe?');
	$pass = trim(fgets(STDIN));
	$users = $authentificate->select('SELECT * FROM user where id= 1');
	$u = 'username';
	$p = 'passwd';
	foreach ($users as $user) {
		$username = $user[$u];
		$passwd = $user[$p];
		if ($usr == $username && $pass == $passwd) {
			$logger->log('Ok, welcome vous êtes dedans!!!');
			$logger->log('---FIN DU PROGRAMME---');
			exit();
		}
	}
	$logger->log('ERREUR,' . $i . 'ème essaie!!!');
}
$logger->log('Non, vous restez dehors!!!');
$logger->log('---FIN DU PROGRAMME---');



