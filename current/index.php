<?php

//////////////////////////////////
// chargement et initialisation //
//////////////////////////////////

// fonctions pour auto-charger les Class.ctr et les OdbClass.mdl
function load_controller($class)
{
	if(is_file('controller/'.$class .'.ctr.php'))
		require_once('controller/'.$class .'.ctr.php');
}
function load_model($class)
{
	if(is_file('model/'.$class .'.mdl.php'))
		require_once('model/'.$class .'.mdl.php');
}
spl_autoload_register('load_controller');
spl_autoload_register('load_model');


// on load les class de gestion des BDD
require_once ('toolSql/Bdd.class.php');
require_once ('toolNosql/Nosql.class.php');
// la class de gestion des menus
require_once ('toolMenu/Menu.class.php');

// on lance la session
session_start();

// on set les obj de connexion SQL et NoSql
require_once 'inc/connexion.inc.php';
// fonction pour afficher les template
require_once 'inc/function.inc.php';

/**
 * contient un objet utilisateur et ses droits
 * on passe true pour signaler que on est en private :
 * seul le script fait les appels
 *
 * @global User $_SESSION['user']
 */
if(empty($_SESSION['user']))
	$_SESSION['user'] = new User(true);



$_SESSION['tampon']['menu'][0]['list'] =
	array(
			'Station'      => 'index.php?page=station&amp;action=lesstations',
			'Intervention' => 'index.php?page=intervention&amp;action=interventions_nt',
			'V&eacute;lo'  => 'index.php?page=velo&amp;action=lesvelos',
		);

$_SESSION['menu'] = new Menu($_SESSION['tampon']['menu']);

//////////////////////////
// Fin d'initialisation //
//////////////////////////

///////////////////////////////////////////////
// Controleur prncipale de gestion des pages //
///////////////////////////////////////////////

// on evite les error de variable !isset
if (!isset($_GET['page']))
	$_GET['page'] = null;

/**
 * switch principale
 *
 * doit gerer les routes pour lancer une instance
 * du controleur correspondent a la demande
 *
 * @param string $_GET['page'] contient la page demandee
 * @author benoit <benoitelie1@gmail.com>
 */
switch ($_GET['page']) {
	case 'velo':
		$velo = new Velo();
		break;

	case 'intervention':
		$intervention = new Intervention();
		break;

	case 'station':

	default:
		$station = new Station();
		break;
}

///////////////////////
// on vide le tampon //
///////////////////////
$_SESSION['tampon'] = null;
