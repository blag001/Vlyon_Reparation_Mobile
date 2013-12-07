<?php
class Intervention
{
	private $odbDemandeInter;
	private $odbBonIntervention;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		$this->odbBonIntervention = new OdbBonIntervention();
		$this->odbDemandeInter = new OdbDemandeInter();

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
		$lesInterventionNT = $this->odbDemandeInter->getLesDemandesNT();
		$_SESSION['tampon']['title'] = 'Toutes Les demandes d interventions non traitees';
		view('htmlHeader');
		view('contentAllDINT', array('lesInterventionNT'=>$lesInterventionNT));
		view('htmlFooter');
	}

	protected function afficherUneDemandeInter()
	{
		if (		!empty($_GET['valeur'])
					and $this->odbDemandeInter->getUneDemandeInter($_GET['valeur'])		)
		{
			$uneDemandeInter = $this->odbDemandeInter->getuneDemandeInter($_GET['valeur']);
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
		$lesInterventions = $this->odbBonIntervention->getLesDemandesInter();
		$lesBonsInter = $this->odbBonIntervention->getLesBonsInter();

		//NON FINI
	}
}
