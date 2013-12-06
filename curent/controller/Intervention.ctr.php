<?php
class Intervention
{
	private $odbIntervention;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		$this->odbIntervention = new odbIntervention();

		if (empty($_GET['action']))
			$_GET['action'] = null;

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

	protected function afficherLesDemandesInter()
	{
		$lesInterventionNT = $this->odbIntervention->getLesDemandesNT();
		$_SESSION['tampon']['title'] = 'Toutes Les demandes d interventions non traitees';
		view('htmlHeader');
		view('contentAllDINT', array('lesInterventionNT'=>$lesInterventionNT));
		view('htmlFooter');
	}

	protected function afficherUneDemandeInter()
	{
		if (		!empty($_GET['valeur'])
					and $this->odbIntervention->getUneDemandeInter($_GET['valeur'])		)
		{
			$uneDemandeInter = $this->odbIntervention->getuneDemandeInter($_GET['valeur']);
			$_SESSION['tampon']['title'] = 'Demande Intervention - '.$uneDemandeInter->DemI_Num;

			view('htmlHeader');
			view('contentOneDemI', array('uneDemandeInter'=>$uneDemandeInter));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['title'] = 'Demande Intervention - ERREUR';
			$_SESSION['tampon']['error'] = array('La Demande Intervention ne semble pas exister...');
			view('htmlHeader');
			view('contentError');
			view('htmlFooter');
		}
	}

	protected function afficherSesInter($codeTechnicien)
	{
		$lesInterventions = $this->odbIntervention->getLesDemandesInter();
		$lesBonsInter = $this->odbIntervention->getLesBonsInter();

		//NON FINI
	}
}
