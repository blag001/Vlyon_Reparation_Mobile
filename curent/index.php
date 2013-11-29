<?php
// on lance la session
session_start();

// fonction pour auto-charger les class.ctr
function load_class($class)
{
	require_once('controller/'.$class .'.ctr.php');
}
spl_autoload_register('load_class');

// on set l'obj de connexion SQL
require_once 'inc/connexion.inc.php';

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

	case 'station':
		$station = new Station();
		break;

	case 'technicien':
		$technicien = new Technicien();
		break;

	default:
		# code...
		break;
}
