<?php
class Velo
{
	/** @var OdbVelo model de gestion Bdd */
	private $odbVelo;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		// on instancie les model
		$this->odbVelo = new OdbVelo();

		// page actuelle
		$_SESSION['tampon']['page'] = 'V&eacute;lo';
		$_SESSION['tampon']['url'] = 'index.php?page=velo';

		if (empty($_GET['action']))
			$_GET['action'] = null;

		/**
		 * Switch de gestion des actions de Intervention
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
		switch ($_GET['action']) {
			case 'unvelo':
				$this->afficherUnVelo();
				break;

			default:
				$this->afficherLesVelos();
				break;
		}
	}

	/**
	 * affiche les stations
	 * @return void
	 */
	protected function afficherLesVelos()
	{
		// $lesVelos = $this->odbVelo->getLesVelos();
		$_SESSION['tampon']['title'] = 'Tous Les Velos';
		view('htmlHeader');
		// view('contentAllStation', array('lesStations'=>$lesStations));
		view('htmlFooter');
	}

	/**
	 * affiche un velo
	 * @return void
	 */
	protected function afficherUnVelo()
	{
		// si on a bien a faire a une station valide
		if (
				!empty($_GET['valeur'])
				and $this->odbVelo->estVelo($_GET['valeur']))
		{
			$unVelo = $this->odbVelo->getUnVelo($_GET['valeur']);

			$_SESSION['tampon']['title'] = 'V&eacute;lo - '.$unVelo->Vel_Num;

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentOneVelo', array('unVelo'=>$unVelo));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['title'] = 'V&eacute;lo - ERREUR';
			$_SESSION['tampon']['error'] = array('Le v&eacute;lo ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}
	}
}
