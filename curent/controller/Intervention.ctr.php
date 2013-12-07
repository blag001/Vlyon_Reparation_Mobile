<?php
class Intervention
{
	/** @var OdbDemandeInter model de gestion Bdd */
	private $odbDemandeInter;
	/** @var OdbBonIntervention model de gestion Bdd */
	private $odbBonIntervention;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		// on instancie les model
		$this->odbDemandeInter = new OdbDemandeInter();
		$this->odbBonIntervention = new OdbBonIntervention();

		// page actuelle
		$_SESSION['tampon']['page'] = 'Intervention';
		$_SESSION['tampon']['url'] = 'index.php?page=intervention';

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
		$lesInterventionNT = $this->odbDemandeInter->getLesDemandesNT();
		$_SESSION['tampon']['title'] = 'Toutes Les demandes d\'interventions non trait&eacute;es';

		/**
		 * Load des vues
		 */
		view('htmlHeader');
		view('contentAllDINT', array('lesInterventionNT'=>$lesInterventionNT));
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
			$uneDemandeInter = $this->odbDemandeInter->getuneDemandeInter($_GET['valeur']);

			$_SESSION['tampon']['title'] = 'Demande Intervention - '.$uneDemandeInter->DemI_Num;

			/**
			 * Load des vues
			 */
			view('htmlHeader');
			view('contentOneDemI', array('uneDemandeInter'=>$uneDemandeInter));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['title'] = 'Demande Intervention - ERREUR';
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
	protected function afficherSesInter($codeTechnicien)
	{
		$lesInterventions = $this->odbBonIntervention->getLesDemandesInter();
		$lesBonsInter = $this->odbBonIntervention->getLesBonsInter();

		//NON FINI
	}
}
