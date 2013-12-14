<?php
class Intervention
{
	/** @var OdbDemandeInter model de gestion Bdd */
	private $odbDemandeInter;
	/** @var OdbBonIntervention model de gestion Bdd */
	private $odbBonIntervention;
	/** @var OdbTechnicien model de gestion Bdd */
	private $odbTechnicien;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		// on instancie les model
		$this->odbDemandeInter = new OdbDemandeInter();
		$this->odbBonIntervention = new OdbBonIntervention();
		$this->odbTechnicien = new OdbTechnicien();

		// page actuelle
		$_SESSION['tampon']['menu']['title'] = 'Intervention';
		$_SESSION['tampon']['menu']['url'] = 'index.php?page=intervention&amp;action=interventions_nt';
		// liste des sous menus
		$_SESSION['tampon']['sous_menu']['list'] =
			array(
					array('url'=>'index.php?page=intervention&amp;action=interventions_nt',
						'title'=>'Non trait&eacute;es'),
					array('url'=>'index.php?page=intervention&amp;action=unbonintervention',
						'title'=>'Une intervention'),
					array('url'=>'index.php?page=intervention&amp;action=sesinterventions' ,
						'title'=>'Ses interventions'),
					array('url'=>'index.php?page=intervention&amp;action=unedemandeinter' ,
						'title'=>'Une demande'),
				);

		if (empty($_GET['action']))
			$_GET['action'] = null;

		/**
		 * Switch de gestion des actions de Intervention
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
		switch ($_GET['action']) {
			case 'unedemandeinter':
				$this->afficherUneDemandeInter();
				break;

			case 'sesinterventions':
				$this->afficherSesInter();
				break;

			case 'unbonintervention':
				$this->afficherUnBonInter();
				break;

			case 'rechercherbonintervention':
				$this->rechercherUnBonInter();
				break;

			case 'interventions_nt':

			default:
				$this->afficherLesDemandesInter();
				break;
		}
	}

	/**
	 * affiche toutes les demandes d'interventions non traitees
	 * @return void
	 */
	protected function afficherLesDemandesInter()
	{
		$lesDemandesINT = $this->odbDemandeInter->getLesDemandesNT();
		$_SESSION['tampon']['html']['title'] = 'Demandes d\'interventions non trait&eacute;es';
		$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=interventions_nt';
		$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Non trait&eacute;es';

		/**
		 * Load des vues
		 */
		view('htmlHeader');
		view('contentAllDINT', array('lesDemandesINT'=>$lesDemandesINT));
		view('htmlFooter');
	}

	/**
	 * affiche une demande d'interventions
	 * @return void
	 */
	protected function afficherUneDemandeInter()
	{
		// si la demande existe
		if (
				!empty($_GET['valeur'])
				and $this->odbDemandeInter->estDemandeInterById($_GET['valeur']))
		{
			$uneDemandeInter = $this->odbDemandeInter->getUneDemandeInter($_GET['valeur']);

			$_SESSION['tampon']['html']['title'] = 'Demande Intervention - '.$uneDemandeInter->DemI_Num;
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unedemandeinter';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une demande';

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentOneDemI', array('uneDemandeInter'=>$uneDemandeInter));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['html']['title'] = 'Demande Intervention - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unedemandeinter';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une demande';

			$_SESSION['tampon']['error'] = array('La Demande d\'Intervention ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}
	}

	/**
	 * @todo a finir
	 */
	protected function afficherSesInter()
	{
		// si la demande existe
		if (
				!empty($_GET['valeur'])
				and $this->odbTechnicien->estTechnicien($_GET['valeur']))
		{
			$sesInterventions = $this->odbBonIntervention->getSesInterventions($_GET['valeur']);

			$_SESSION['tampon']['html']['title'] = 'Toutes interventions du technicien';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=sesinterventions';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Ses interventions';

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentSesInterventions', array('sesInterventions'=>$sesInterventions));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['html']['title'] = 'Toutes interventions du technicien - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=sesinterventions';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Ses interventions';

			$_SESSION['tampon']['error'] = array('Le Technicien ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}

	}

	protected function afficherUnBonInter()
	{
		/*
		$unBonInter = $this->odbBonIntervention->getUnBonInter($codeBonInter);

		$_SESSION['tampon']['html']['title'] = 'Un bon d\'intervention';
		$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unbonintervention';
		$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une intervention';

		/**
		 * Load des vues
		 *
		view('htmlHeader');
		view('contentOneBonInter', array('unBonIntervention'=>$unBonIntervention));
		view('htmlFooter');
		*/


		// si le bon existe
		if (
				!empty($_GET['valeur'])
				and $this->odbBonIntervention->estBonInter($_GET['valeur']))
		{
			$unBonInter = $this->odbBonIntervention->getUnBonInter($_GET['valeur']);

			$_SESSION['tampon']['html']['title'] = 'Bon Intervention - '.$unBonInter->BI_Num;
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Un bon';

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentOneBonInter', array('unBonInter'=>$unBonInter));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['html']['title'] = 'Bon Intervention - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Un bon';

			$_SESSION['tampon']['error'] = array('Le bon d\'Intervention ne semble pas exister...');

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}

	}

	/**
	 * @todo  NON FINI EN DESSOUS
	 * @return void
	 */
	protected function rechercherUnBonInter()
	{
		$_SESSION['tampon']['html']['title'] = 'Rechercher un bon d\'intervention';
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
