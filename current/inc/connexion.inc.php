<?php
	/**
	 * instanciation de la connexion BDD dans une variable de session
	 *
	 * /!\ changez ici par vos informations de connexion /!\
	 *
	 * Par defaut, si null ou false dans le "Bdd()" :
	 * 		$host       = 'localhost';
	 * 		$db_name    = 'test';
	 * 		$user       = 'root';
	 * 		$mdp        = '';
	 * 		$production = false;
	 *
	 * @param string $host l'host a utiliser (localhost by def)
	 * @param string $db_name nom de la base de donnee
	 * @param string $user utilisateur de la BDD
	 * @param string $mdp mot de passe de l'utilisateur
	 * @param string $production (des)active les messages d'erreurs
	 */

if (empty($_SESSION['bdd']))
	$_SESSION['bdd'] = new Bdd(null, null, 'sio', 'KpurqD5Ey4NQSYVU');

	/**
	 * inctanciation de l'obj NoSql
	 *
	 * @param string $path_db chemin du dossier de stockage
	 */
	if(empty($_SESSION['nosql']))
		$_SESSION['nosql'] = new Nosql();
