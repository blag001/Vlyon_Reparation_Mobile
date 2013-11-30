<?php
// on load les class
require_once ('toolSql/Bdd.class.php');
require_once ('toolNosql/Nosql.class.php');
try {
	// creation de l'obj BDD
	// args : ($host, $db_name, $user, $mdp)
	$_SESSION['bdd'] = new Bdd();

	// creation de l'obj NoSql
	// args : ($path_db)
	$_SESSION['nosql'] = new Nosql();

} catch (Exception $e) {
	die('Une erreur avec la base de donnee c\'est produite');
}
