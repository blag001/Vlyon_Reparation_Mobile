<?php
class Station
{
	/** @var OdbStation model de gestion Bdd */
	private $odbStation;
	/** @var OdbVelo model de gestion Bdd */
	private $odbVelo;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		// on instancie les model
		$this->odbStation = new OdbStation();
		$this->odbVelo = new OdbVelo();

		// page actuelle
		$_SESSION['tampon']['page'] = 'Station';
		$_SESSION['tampon']['url'] = 'index.php?page=station';

		if (empty($_GET['action']))
			$_GET['action'] = null;

		/**
		 * Switch de gestion des actions de Station
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
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

		if (empty($lesStations))
			$_SESSION['tampon']['error'] = array('Pas de station...');

		/**
		 * Load des vues
		 */
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
		// si on a bien a faire a une station valide
		if (
				!empty($_GET['valeur'])
				and $this->odbStation->estStationById($_GET['valeur']))
		{
			$uneStation = $this->odbStation->getUneStation($_GET['valeur']);
			$lesVelosByStation = $this->odbVelo->getLesVelosDeStation($_GET['valeur']);

			$_SESSION['tampon']['title'] = 'Station - '.$uneStation->Sta_Nom;

			if (empty($lesVelosByStation))
				$_SESSION['tampon']['error'] = array('Pas de v&eacute;lo pour cette station...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentOneStation', array('uneStation'=>$uneStation,
				'lesVelos'=>$lesVelosByStation));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['title'] = 'Station - ERREUR';
			$_SESSION['tampon']['error'] = array('La station ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}
	}
}
