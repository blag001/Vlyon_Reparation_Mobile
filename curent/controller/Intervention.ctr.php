<?php
class Intervention
{
		/** @var OdbDemandeInter model de gestion Bdd */
	private $odbDemandeInter;
		/** @var OdbBonIntervention model de gestion Bdd */
	private $odbBonIntervention;

	/** @var OdbVelo model de velo Bdd */

		/** @var OdbVelo model de gestion Velo en Bdd */
	private $odbVelo;

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
		$this->odbDemandeInter = new OdbDemandeInter();
		$this->odbBonIntervention = new OdbBonIntervention();
		$this->odbVelo = new OdbVelo();

			// page actuelle
		$_SESSION['tampon']['menu']['title'] = 'Intervention';
		$_SESSION['tampon']['menu']['url'] = 'index.php?page=intervention&amp;action=interventions_nt';
			// liste des sous menus
		$_SESSION['tampon']['sous_menu']['list'] =
			array(
					array('url'=>'index.php?page=intervention&amp;action=interventions_nt',
						'title'=>'Non trait&eacute;es'),
					array('url'=>'index.php?page=intervention&amp;action=creerbonintervention' ,
						'title'=>'Intervenir'),
					array('url'=>'index.php?page=intervention&amp;action=mesinterventions' ,
						'title'=>'Mes interventions'),
					array('url'=>'index.php?page=intervention&amp;action=rechercherbonintervention' ,
						'title'=>'Rechercher intervention'),
					array('url'=>'index.php?page=intervention&amp;action=monbonintervention',
						'title'=>'Une intervention'),
					// array('url'=>'index.php?page=intervention&amp;action=creerdemandeinter' ,
					// 	'title'=>'Demander'),
					// array('url'=>'index.php?page=intervention&amp;action=rechercherdemandeinter' ,
					// 	'title'=>'Rechercher intervention'),
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

			case 'mesinterventions':
				$this->afficherMesInter();
				break;

			case 'monbonintervention':
				$this->afficherMonBonInter();
				break;

			case 'rechercherbonintervention':
				$this->rechercherUnBonInter();
				break;

			case 'creerbonintervention':
				$this->creerUnBonIntervention();
				break;

			case 'creerdemandeinter':
				$this->creerUneDemandeInter();
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
		view('contentMenu');
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
				and $this->odbDemandeInter->estDemandeInter($_GET['valeur']))
		{
			$uneDemandeInter = $this->odbDemandeInter->getUneDemandeInter($_GET['valeur']);

			$_SESSION['tampon']['html']['title'] = 'Demande Intervention - '.$uneDemandeInter->DemI_Num;
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unedemandeinter';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une demande';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentOneDemI', array('uneDemandeInter'=>$uneDemandeInter));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['html']['title'] = 'Demande Intervention - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=unedemandeinter';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une demande';

			$_SESSION['tampon']['error'][] = 'La Demande d\'Intervention ne semble pas exister...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}
	}

		/**
		 * affiche ses interv quand on est technicient
		 * @return void
		 */
	protected function afficherMesInter()
	{
			// si le compte est bien celui d'un tech
		if ($_SESSION['user']->estTechnicien())
		{
			$mesInterventions = $this->odbBonIntervention->getMesInterventions($_SESSION['user']->getMatricule());

			$_SESSION['tampon']['html']['title'] = 'Toutes mes interventions';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=mesinterventions';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Mes interventions';

			if (empty($mesInterventions))
				$_SESSION['tampon']['error'][] = 'Pas d\'Intervention...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentMesInterventions', array('mesInterventions'=>$mesInterventions));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['html']['title'] = 'Toutes mes interventions - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=mesinterventions';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Mes interventions';

			$_SESSION['tampon']['error'][] = 'Vous ne semblez pas &ecirc;tre Technicien...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}

	}

		/**
		 * affiche un bon d'interv quand on est technicient
		 * @return void
		 */
	protected function afficherMonBonInter()
	{
			// si le bon existe
		if (
				!empty($_GET['valeur'])
				and $_SESSION['user']->estTechnicien()
				and $this->odbBonIntervention->estMonBonInter($_GET['valeur'], $_SESSION['user']->getMatricule())
			)
		{
			$unBonInter = $this->odbBonIntervention->getMonBonInter($_GET['valeur'], $_SESSION['user']->getMatricule());

			$_SESSION['tampon']['html']['title'] = 'Bon Intervention - '.$unBonInter->BI_Num;
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=monbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une intervention';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentOneBonInter', array('unBonInter'=>$unBonInter));
			view('htmlFooter');
		}
		elseif(!empty($_GET['valeur']))
		{
			$_SESSION['tampon']['html']['title'] = 'Bon Intervention - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=monbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Une intervention';

			$_SESSION['tampon']['error'][] = 'Le bon d\'Intervention ne semble pas exister...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}
		else
			$this->rechercherUnBonInter();

	}

		/**
		 * permet une recherche dans ses bons d'interventions
		 * @return void
		 */
	protected function rechercherUnBonInter()
	{
		if ($_SESSION['user']->estTechnicien())
		{
				// si une valeur, on lance la recherche
			if(isset($_GET['valeur']) and $_GET['valeur'] !== '')
				$lesBonsInter = $this->odbBonIntervention->searchMesBonIntervention($_GET['valeur'], $_SESSION['user']->getMatricule());
			else // par def on charge tout mes bons
				$lesBonsInter = $this->odbBonIntervention->getMesInterventions($_SESSION['user']->getMatricule());

			$_SESSION['tampon']['html']['title'] = 'Rechercher un bon d\'intervention';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=rechercherbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Rechercher intervention';

				// rien en retour ? une erreur
			if (empty($lesBonsInter))
				$_SESSION['tampon']['error'][] = 'Pas de bon...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentSearchBonIntervention');
			view('contentMesInterventions', array('mesInterventions'=>$lesBonsInter));
			view('htmlFooter');
		}
		else
		{
			$_SESSION['tampon']['html']['title'] = 'Rechercher un bon d\'intervention - ERREUR';
			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=intervention&amp;action=rechercherbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Mes interventions';

			$_SESSION['tampon']['error'][] = 'Vous ne semblez pas &ecirc;tre Technicien...';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentError');
			view('htmlFooter');
		}
	}

		/**
		 * @todo faire les controle si envois ou non (enregistrement ou form)
		 * @todo  faire les check de data avant de lancer le save()
		 * @return void
		 */
	protected function creerUnBonIntervention()
	{
		/**
		 * On regarde si on a deja des valeurs pour pre-remplir
		 *
		 * soit un code de demande d'intervention
		 * soit un code de velo
		 * sinon on met des null
		 */
		if(
			isset($_GET['code_demande'])
			and $this->odbDemandeInter->estDemandeInter($_GET['code_demande'])
			)
		{
			$leVeloNum = $this->odbDemandeInter->getIdVeloByIdDemandeInter($_GET['code_demande']);
			$laDemandeInterNum = $_GET['code_demande'];
		}
		elseif(
			isset($_GET['code_velo'])
			and $this->odbVelo->estVelo($_GET['code_velo'])
			)
		{
				$leVeloNum = $_GET['code_velo'];
				$laDemandeInterNum = null;
			}
		else{
				$leVeloNum = null;
				$laDemandeInterNum = null;
		}


			// si on a un envois valide, on lance la sauvegarde
		if( ($error = $this->checkSubmitBonI()) == null and isset($_POST['sbmtMkBon']) )
		{
			// en cours
			$dateDebut = date_create($_POST['dateDebut']);
			$dateFin = date_create($_POST['dateFin']);
			$dureeAbs = $dateDebut->diff($dateFin, true);
			$_POST['duree'] = $duree->format('%a') + 1;

			$_POST['dateDebut'] = $dateDebut->format('Y-m-d');
			$_POST['dateFin'] = $dateFin->format('Y-m-d');

			if (!empty($_POST['reparable']))
				$_POST['reparable'] = 1;
			else
				$_POST['reparable'] = 0;

			if (empty($_POST['demande']))
				$_POST['demande'] = null;

			if (!empty($_POST['surPlace']))
				$_POST['surPlace'] = 1;
			else
				$_POST['surPlace'] = 0;

			$unNouveauBon = $this->odbBonIntervention->creerUnBonInter();
			echo "ok !";
		}
		else // si pas d'envoi ou pas valide
		{
			//on recupere tous les codes velos pour la liste deroulante
			$lesVelos = $this->odbVelo->getLesVelos();

			$_SESSION['tampon']['title'] = 'Cr&eacute;er un bon d\'intervention';

			$_SESSION['tampon']['html']['title'] = 'Cr&eacute;er un bon d\'intervention';

			$_SESSION['tampon']['sous_menu']['curent']['url'] = 'index.php?page=station&amp;action=creerbonintervention';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Intervenir';
			// var_dump($error);
			// var_dump($_POST);
				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentCreerUnBon', array(
				'leVeloNum'=>$leVeloNum,
				'laDemandeInterNum'=>$laDemandeInterNum,
				'lesVelos'=>$lesVelos,
				));
			view('htmlFooter');
		}

	}

	private function checkSubmitBonI()
	{
		// var pour la validatation des envois
		$error = null;

			// si on a une demande
		if(!empty($_POST['demande'])){
				// si la demande n'existe pas
			if(!$this->odbDemandeInter->estDemandeInter($_GET['demande']))
				$error['demande'][] = 'La demande ne semble pas exister...';
				// si elle n'a pas de velo liee
			elseif ( !($code_velo = $this->odbDemandeInter->getIdVeloByIdDemandeInter($_GET['code_demande'])) )
				$error['demande'][] = 'Pas de velo li&eacute; &agrave; cette demande...';
				// si le velo liee est introuvable
			elseif ( !$this->odbVelo->estVelo($code_velo) )
				$error['demande'][] = 'Le velo ne semble pas exister...';
				// si on a bidouiller pour changer l'idVelo dans le html
			elseif ( $code_velo != $_POST['Vel_Num'] )
				$error['Vel_Num'][] = 'On ne hack pas l\'application SVP...';
		}
			// si on a pas de velo
		elseif (empty($_POST['Vel_Num']))
			$error['Vel_Num'][] = 'Merci de selectionner un v&eacute;lo...';
			// si le velo est introuvable
		elseif( !$this->odbVelo->estVelo($_POST['Vel_Num']) )
			$error['Vel_Num'][] = 'Le velo ne semble pas exister...';

			// si pas de date debut
		if (empty($_POST['dateDebut']))
			$error['dateDebut'][] = 'Merci de remplir une date de d&eacute;but...';

			// si pas de date de fin
		if (empty($_POST['dateFin']))
			$error['dateFin'][] = 'Merci de remplir une date de fin...';

			// si pas de compte rendu
		if (empty($_POST['cpteRendu']))
			$error['cpteRendu'][] = 'Le compte-rendu doit être remplis !';

		return $error;
	}

	# @todo mettre en place les verifs
	protected function creerUneDemandeInter()
	{
			$leVeloNum = null;
			$laDemandeInterNum = null;

			//on recupere tous les codes velos pour la liste deroulante
			$lesVelos = $this->odbVelo->getLesVelos();

			$_SESSION['tampon']['title'] = 'Cr&eacute;er une demande d\'intervention';

			$_SESSION['tampon']['html']['title'] = 'Cr&eacute;er une demande d\'intervention';

			$_SESSION['tampon']['sous_menu']['curent']['url'] = '';
			$_SESSION['tampon']['sous_menu']['curent']['title'] = 'Demander';

				/**
				 * Load des vues
				 */
			view('htmlHeader');
			view('contentMenu');
			view('contentCreerUneDemande', array(
				'leVeloNum'=>$leVeloNum,
				'laDemandeInterNum'=>$laDemandeInterNum,
				'lesVelos'=>$lesVelos,
				));
			view('htmlFooter');
	}

}
