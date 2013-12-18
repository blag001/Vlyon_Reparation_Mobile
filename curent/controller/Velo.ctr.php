<?php
class Velo
{
	/** @var OdbVelo model de gestion Bdd */
	private $odbVelo;
	/** @var OdbStation model de gestion Bdd */
	private $odbStation;
	/** @var odbEtat model de gestion Bdd */
	private $odbEtat;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			$_SESSION['user']->displayForm();
			die;
		}
		// si il est connecte
		// on instancie les model
		$this->odbVelo = new OdbVelo();
		$this->odbStation = new OdbStation();
		$this->odbEtat = new OdbEtat();
		$this->odbProduit = new OdbProduit();

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
					array('url'=>'index.php?page=velo&amp;action=modifiervelo',
						'title'=>'Modifier'),
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
			case 'modifiervelo':
				$this->modifierUnVelo();
				break;

			case 'recherchervelo':

			default:
				$this->rechercherUnVelo();
				break;
		}
	}

	/**
	 * rechercher un velo via input user
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
			$_SESSION['tampon']['error'][] = 'Pas de v&eacute;lo...';

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

			$_SESSION['tampon']['error'][] = 'Le v&eacute;lo ne semble pas exister...';

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
	/**
	 * modifer un velo
	 * @todo  a faire
	 * @return void
	 */
	protected function modifierUnVelo()
	{

		if(
			isset($_GET['valeur'])
			and $_GET['valeur'] !== ''
			and $this->odbVelo->estVelo($_GET['valeur'])
			)
		{
			$leVelo = $this->odbVelo->getUnVelo($_GET['valeur']);
			$lesStations = $this->odbStation->getLesIdStations();
			$lesEtats = $this->odbEtat->getLesEtats();
			$lesTypes = $this->odbProduit->getLesTypes();


			$_SESSION['tampon']['html']['title'] = 'Modifier un V&eacute;lo';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=velo&amp;action=modifiervelo';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Modifier v&eacute;lo';

			if (empty($lesStations))
				$_SESSION['tampon']['error'][] = 'Aucune station dans la base !';
			if (empty($lesEtats))
				$_SESSION['tampon']['error'][] = 'Aucun &eacute;tat dans la base !';

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentMenu');
			view('contentModifierUnVelo', array(
					'lesStations'=>$lesStations,
					'leVelo'=>$leVelo,
					'lesEtats'=>$lesEtats,
					'lesTypes'=>$lesTypes,
					));
			view('htmlFooter');
		}
		else
		{

			$_SESSION['tampon']['html']['title'] = 'Modifier un V&eacute;lo - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=velo&amp;action=modifiervelo';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Modifier v&eacute;lo';

			$_SESSION['tampon']['error'][] = 'Le v&eacute;lo ne semble pas exister...';

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}
	}
}
