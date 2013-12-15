<?php
class Velo
{
	/** @var OdbVelo model de gestion Bdd */
	private $odbVelo;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			$_SESSION['user']->displayForm();
			die;
		}
		// si il est connecte
		// on instancie les model
		$this->odbVelo = new OdbVelo();

		// page actuelle
		$_SESSION['tampon']['menu']['title'] = 'V&eacute;lo';
		$_SESSION['tampon']['menu']['url'] = 'index.php?page=unvelo&amp;action=lesvelos';
		// liste des sous menus
		$_SESSION['tampon']['sous_menu']['list'] =
			array(
					array('url'=>'index.php?page=velo&amp;action=recherchervelo',
						'title'=>'Rechercher v&eacute;lo'),
					array('url'=>'index.php?page=velo&amp;action=unvelo',
						'title'=>'Un v&eacute;lo'),
				);

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

			case 'recherchervelo':

			default:
				$this->rechercherUnVelo();
				break;
		}
	}

	/**
	 * affiche les stations
	 * @return void
	 */
	protected function rechercherUnVelo()
	{
		$lesVelos = null;

		if(isset($_GET['valeur']) and $_GET['valeur'] !== '')
			$lesVelos = $this->odbVelo->searchVelos($_GET['valeur']);

		$_SESSION['tampon']['html']['title'] = 'Rechercher Un v&eacute;lo';
		$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=station&amp;action=recherchervelo';
		$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Rechercher v&eacute;lo';

		if (empty($lesVelos))
			$_SESSION['tampon']['error'] = array('Pas de v&eacute;lo...');

		/**
		 * Load des vues
		 */
		view('htmlHeader');
		view('contentMenu');
		view('contentSearchVelo');
		view('contentAllVelo', array('lesVelos'=>$lesVelos));
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

			$_SESSION['tampon']['html']['title'] = 'V&eacute;lo - '.$unVelo->Vel_Num;
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=velo&amp;action=unvelo';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Un v&eacute;lo';

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentMenu');
			view('contentOneVelo', array('unVelo'=>$unVelo));
			view('htmlFooter');
		}
		elseif(!empty($_GET['valeur']))
		{
			$_SESSION['tampon']['html']['title'] = 'V&eacute;lo - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=velo&amp;action=unvelo';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Un v&eacute;lo';

			$_SESSION['tampon']['error'] = array('Le v&eacute;lo ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}
		else
			$this->rechercherUnVelo();
	}
}
