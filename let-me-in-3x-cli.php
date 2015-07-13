<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

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

for ($i = 1; $i <= 3 || $isAuthenticated; $i++) {
	$logger->log('Bonjour, qui êtes-vous?');
	$username = trim(fgets(STDIN));
	$logger->log('Et votre passe?');
	$password = trim(fgets(STDIN));
	# @todo use md5
	# md5($password)
	$user = $database->selectOne('SELECT * FROM user where username = "' . $username . '" AND passwd = "' . $password.'" LIMIT 1');
	#if (isset($user) && $user['username']==$username && $user['passwd']==$password ) {
	if (!empty($user)) {
		$logger->log('Ok, welcome vous êtes dedans!!!');
		$isAuthenticated = TRUE;
	}
	$logger->log('ERREUR,' . $i .'ème essaie!!!');
}
$logger->log('Non, vous restez dehors!!!');
