<?php
class Station
{
	/** @var OdbStation model obj de gestion station en Bdd */
	private $odbStation;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		$this->odbStation = new OdbStation();
		$this->odbVelo = new OdbVelo();

		/**
		 * Switch de gestion des actions de Station
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
		if (empty($_GET['action']))
			$_GET['action'] = null;

		switch ($_GET['action']) {
			case 'unestation':
				$this->afficherUneStation();
				break;

			default:
				$this->afficherLesStations();
				break;
		}
	}
	/**
	 * affiche les stations
	 * @return void
	 */
	protected function afficherLesStations()
	{
		$lesStations = $this->odbStation->getLesStations();
		$_SESSION['tampon']['title'] = 'Toutes Les Stations';
		view('htmlHeader');
		view('contentAllStation', array('lesStations'=>$lesStations));
		view('htmlFooter');
	}
	/**
	 * affiche une station et ses velos lies
	 * @return void
	 */
	protected function afficherUneStation()
	{
		if (
				!empty($_GET['valeur'])
				and $this->odbStation->estStationById($_GET['valeur']))
		{
			$uneStation = $this->odbStation->getUneStation($_GET['valeur']);
			$_SESSION['tampon']['title'] = 'Station - '.$uneStation->Sta_Nom;

			$lesVelosByStation = $this->odbVelo->getLesVelosDeStation($_GET['valeur']);

			view('htmlHeader');
			view('contentOneStation', array('uneStation'=>$uneStation,
				'lesVelos'=>$lesVelosByStation));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['title'] = 'Station - ERREUR';
			$_SESSION['tampon']['error'] = array('La station ne semble pas exister...');
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}
	}
}
