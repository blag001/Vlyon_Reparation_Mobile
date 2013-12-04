<?php
// on lance la session
session_start();

// fonctions pour auto-charger les Class.ctr et les OdbClass.mdl
function load_controller($class)
{
	require_once('controller/'.$class .'.ctr.php');
}
function load_model($class)
{
	require_once('model/'.$class .'.mdl.php');
}
spl_autoload_register('load_controller');
spl_autoload_register('load_model');

// on set les obj de connexion SQL et NoSql
require_once 'inc/connexion.inc.php';
// fonction pour afficher les template
require_once 'inc/template.inc.php';

// obj ustilisateur (gestion des droits)
$_SESSION['user'] = new User();

// on evite les error de variable !isset
if (!isset($_GET['page']))
	$_GET['page'] = null;

/**
 * switch principale
 *
 * doit gerer les routes pour lancer une instance
 * du controleur corespondent a la demande
 *
 *@param string $_GET['page'] contient la page demandee
 *@author benoit
 */
switch ($_GET['page']) {
	case 'velo':
		$velo = new Velo();
		break;

	case 'technicien':
		$technicien = new Technicien();
		break;

	case 'station':
		$station = new Station();
		break;
	default:
		echo 'hello';
		break;
}
