<?php
try {
	/**
	 * instanciation de la connexion BDD
	 *
	 * changez les null par vos informations
	 * par defaut (si null ou false) :
	 * 		$host    = 'localhost';
	 * 		$db_name = 'sio_reparation';
	 * 		$user    = 'root';
	 * 		$mdp     = '';
	 *
	 * @param string $host l'host a utiliser (localhost by def)
	 * @param string $db_name nom de la base de donnee
	 * @param string $user utilisateur de la BDD
	 * @param string $mdp mot de passe de l'utilisateur
	 */
	if (empty($_SESSION['bdd']))
		$_SESSION['bdd'] = new Bdd(null, null, null, null);

	/**
	 * inctanciation de l'obj NoSql
	 *
	 * @param string $path_db chemin du dossier de stockage
	 */
	if(empty($_SESSION['nosql']))
		$_SESSION['nosql'] = new Nosql();

} catch (Exception $e) {
	die('Une erreur avec la base de donnee c\'est produite');
}
