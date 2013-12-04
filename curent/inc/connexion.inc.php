<?php
// on load les class
require_once ('toolSql/Bdd.class.php');
require_once ('toolNosql/Nosql.class.php');
try {
	// creation de l'obj BDD
	// args : ($host, $db_name, $user, $mdp)
	if (empty($_SESSION['bdd']))
		$_SESSION['bdd'] = new Bdd();

	// creation de l'obj NoSql
	// args : ($path_db)
	if(empty($_SESSION['nosql']))
		$_SESSION['nosql'] = new Nosql();

} catch (Exception $e) {
	die('Une erreur avec la base de donnee c\'est produite');
}
