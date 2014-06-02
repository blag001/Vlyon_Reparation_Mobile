<?php
/**
 * fichier de declaration de l'autoload pour phpUnit
 */

//////////////////////////////////
// chargement et initialisation //
//////////////////////////////////

	require_once ('vendor/autoload.php');

		// on lance la session
	session_start();

		// on set les obj de connexion SQL et NoSql
	require_once 'src/inc/connexion.inc.php';
		// fonction pour afficher les template
	require_once 'src/inc/function.inc.php';

///////////////////////////
//fin de l'instanciation //
///////////////////////////
