<?php
/**
 * fichier à inclure pour instancier la connexion
 *
 * Il crée une instance de la connexion à la BDD dans la SESSION
 * Il crée une instance de la connexion au NoSql dans la SESSION
 */
	/**
	 * instanciation de la connexion BDD dans une variable de session
	 *
	 * @todo  /!\ changez ici par vos informations de connexion /!\
	 *
	 * Par défaut, si null ou false dans le "Bdd()" :
	 * 		$host       = 'localhost';
	 * 		$db_name    = 'test';
	 * 		$user       = 'root';
	 * 		$mdp        = '';
	 * 		$production = false;
	 *
	 * @param string $host l'host à utiliser (localhost par défaut)
	 * @param string $db_name nom de la base de données
	 * @param string $user utilisateur de la BDD
	 * @param string $mdp mot de passe de l'utilisateur
	 * @param bool $production (dés)active les messages d'erreurs
	 */
if (Bdd::needInstance())
	$_SESSION['bdd'] = new Bdd(null, 'sio_reparation', 'root', '', false);


	/**
	 * inctanciation de l'obj NoSql
	 *
	 * @param string $path_db chemin du dossier de stockage
	 */
if(empty($_SESSION['nosql']))
	$_SESSION['nosql'] = new Nosql();
