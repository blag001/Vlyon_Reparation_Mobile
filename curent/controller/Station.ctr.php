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
		$_SESSION['tampon']['menu']['title'] = 'Station';
		$_SESSION['tampon']['menu']['url'] = 'index.php?page=station&amp;action=lesstations';
		// liste des sous menus
		$_SESSION['tampon']['sous_menu']['list'] =
			array(
					array('url'=>'index.php?page=station&amp;action=lesstations',
						'title'=>'Les stations'),
					array('url'=>'index.php?page=station&amp;action=unestation',
						'title'=>'Une station'),
					array('url'=>'index.php?page=station&amp;action=rechercherstation' ,
						'title'=>'Rechercher station'),
				);

		if (empty($_GET['action']))
			$_GET['action'] = null;

		/**
		 * Switch de gestion des actions de Station
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
		switch ($_GET['action']) {
			case 'rechercherstation':
				$this->rechercherUneStation();
				break;
			case 'unestation':
				$this->afficherUneStation();
				break;

			case 'lesstations':

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

		$_SESSION['tampon']['html']['title'] = 'Toutes Les Stations';
		$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=station&amp;action=lesstations';
		$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Les stations';

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

			$_SESSION['tampon']['html']['title'] = 'Station - '.$uneStation->Sta_Nom;
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=station&amp;action=unestation';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une station';

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
		elseif(!empty($_GET['valeur']))
		{
			$_SESSION['tampon']['html']['title'] = 'Station - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=station&amp;action=unestation';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une station';
			$_SESSION['tampon']['error'] = array('La station ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}
		else
			$this->rechercherUneStation();
	}

	/**
	 * affiche une station et ses velos lies
	 * @return void
	 */
	protected function rechercherUneStation()
	{
		$_SESSION['tampon']['html']['title'] = 'Rechercher Une Station';
		$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=station&amp;action=rechercherstation';
		$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Rechercher station';

		/**
		 * Load des vues
		 */
		view('htmlHeader');
		view('contentSearchStation');
		view('htmlFooter');
	}
}
