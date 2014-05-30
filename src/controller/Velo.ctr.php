<?php
/**
 * fichier de declaration de la class controller des Velo
 */

	/**
	 * class controller Velo
	 *
	 * controleur pour les Velo
	 * Charger d'appeller les methodes suivant les demandes
	 */
class Velo
{
		/** @var OdbVelo model de gestion Velo en Bdd */
	private $odbVelo;
		/** @var OdbStation model de gestion Station en Bdd */
	private $odbStation;
		/** @var odbEtat model de gestion Etat Velo en Bdd */
	private $odbEtat;

		/**
		 * constructeur du controller
		 */
	public function __construct()
	{
			/**
			 * On regarde si le user est connecte,
			 * si non, on lui affiche le formulaire de coo,
			 * et on termine le script
			 */
		if (!($_SESSION['user']->estUser())) {
			$_SESSION['user']->displayForm();
			die;
		}

			// si il est connecte
			// on instancie les model (lien avec la BDD)
		$this->odbVelo = new OdbVelo();
		$this->odbStation = new OdbStation();
		$this->odbEtat = new OdbEtat();
		// $this->odbProduit = new OdbProduit();

			// page actuelle dans le menu principale
		$_SESSION['tampon']['menu'][0]['current'] = 'V&eacute;lo';
			// liste des sous menus
		$_SESSION['tampon']['menu'][1]['list'] =
			array(
					'Rechercher v&eacute;lo' => 'index.php?page=velo&amp;action=recherchervelo',
					'Modifier'               => 'index.php?page=velo&amp;action=modifiervelo',
					'Un v&eacute;lo'         => 'index.php?page=velo&amp;action=unvelo',
				);

			// on evite les erreurs en cas de pas d'action
		if (empty($_GET['action']))
			$_GET['action'] = null;

			/**
			 * Switch de gestion des actions de Intervention
			 * se charge d'appeller la methode pour l'action requise
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
			case 'ajaxrecherchervelo':
				$this->ajaxRechercherUnVelo();
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

			/** si valeur, on lance la recherche */
		if(isset($_GET['valeur']) and $_GET['valeur'] !== '')
			$lesVelos = $this->odbVelo->searchVelos($_GET['valeur']);
		else
			$lesVelos = $this->odbVelo->getNouveauxVelos();

		$_SESSION['tampon']['html']['title'] = 'Rechercher Un v&eacute;lo';
		$_SESSION['tampon']['menu'][1]['current'] = 'Rechercher v&eacute;lo';

			// si pas de velo, erreur
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
		 * rechercher un velo via input user depuis une requete AJAX
		 * @return void
		 */
	protected function ajaxRechercherUnVelo()
	{
		$lesVelos = null;

			/** si valeur, on lance la recherche */
		if(isset($_GET['valeur']) and $_GET['valeur'] !== '')
			$lesVelos = $this->odbVelo->searchVelos($_GET['valeur']);
		else
			$lesVelos = $this->odbVelo->getNouveauxVelos();

			// si pas de velo, erreur
		if (empty($lesVelos))
			$_SESSION['tampon']['error'][] = 'Pas de v&eacute;lo...';

			/**
			 * Load des vues
			 */
		view('contentAllVelo', array('lesVelos'=>$lesVelos, 'isAjax'=>true));
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
			$_SESSION['tampon']['menu'][1]['current'] = 'Un v&eacute;lo';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');

			if (!empty($_SESSION['tampon']['success']))
				view('contentSuccess');

			view('contentOneVelo', array('unVelo'=>$unVelo));
			view('htmlFooter');
		}
			// sinon si on a une valeur, mais que on a pas valider le estVelo
		elseif(!empty($_GET['valeur']))
		{
			$_SESSION['tampon']['html']['title'] = 'V&eacute;lo - ERREUR';
			$_SESSION['tampon']['menu'][1]['current'] = 'Un v&eacute;lo';

			$_SESSION['tampon']['error'][] = 'Le v&eacute;lo ne semble pas exister...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}
		else // par defaut on affiche la page de recherche
			$this->rechercherUnVelo();
	}

		/**
		 * modifer un velo
		 * appelle les methodes privee pour realiser la modification
		 * @return void
		 */
	protected function modifierUnVelo()
	{

			/**
			 * Si le velo existe, on peut lancer le module
			 * sinon on passe directement a une erreur
			 */
		if(
			isset($_GET['valeur'])
			and $this->odbVelo->estVelo($_GET['valeur'])
			)
		{
				/** @var array stock les erreurs de la modification du velo */
			$has_error = array();

				/**
				 * Si on a un envois de fomulaire sur la demande de modification de velo
				 */
			if (!empty($_POST))
			{
					/**
					 * on test les valeurs
					 */
					/** que la station existe bien */
				if (!isset($_POST['stationVelo'])
					or !$this->odbStation->estStationById($_POST['stationVelo']))
					$has_error['stationVelo'] = true;
					/** que l'etat existe lui aussi */
				if (!isset($_POST['etatVelo'])
					or !$this->odbEtat->estEtatById($_POST['etatVelo']))
					$has_error['etatVelo'] = true;
					/** que le champ accessoire a pas etais supprime */
				if (!isset($_POST['accessoireVelo']))
					$has_error['accessoireVelo'] = true; // on ne supprime pas des champs...
					/** on charge le code du velo a modifier directement depuis le GET */
				$_POST['codeVelo'] = $_GET['valeur'];

					/**
					 * si aucune erreur trouvee
					 */
				if (empty($has_error))
				{
						// on lance la modif
					$outModifVelo = $this->odbVelo->modifierUnVelo();
						/** si on a un nombre de ligne >0 et donc TRUE */
					if ($outModifVelo)
					{
						$_SESSION['tampon']['success'][] =
							'Modification du v&eacute;lo No '.$_GET['valeur'].' r&eacute;ussie !';
							// on redirige vers la page d'affiche d'un velo
						header('Location:index.php?page=velo&action=unvelo&valeur='.$_GET['valeur']);
						die; // on stop le chargement de la page
					}
					else // sinon on charge une erreur
						$_SESSION['tampon']['error'][] = 'Erreur avec la modification du v&eacute;lo No '.$_GET['valeur'];
				}
			}

				/**
				 * partie principal de la modif velo, on va chercher les info
				 * - du velo
				 * - des stations
				 * - des etats
				 * - des types de velo
				 */

			$leVelo = $this->odbVelo->getUnVelo($_GET['valeur']);
			$lesStations = $this->odbStation->getLesIdStations();
			$lesEtats = $this->odbEtat->getLesEtats();


			$_SESSION['tampon']['html']['title'] = 'Modifier un V&eacute;lo';
			$_SESSION['tampon']['menu'][1]['current'] = 'Modifier';

				/** en cas de retour vide sur une des valeurs */
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
					'has_error'=>$has_error,
					));
			view('htmlFooter');
		}
		elseif(isset($_GET['valeur']))
		{

			$_SESSION['tampon']['html']['title'] = 'Modifier un V&eacute;lo - ERREUR';
			$_SESSION['tampon']['menu'][1]['current'] = 'Modifier v&eacute;lo';

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
}
