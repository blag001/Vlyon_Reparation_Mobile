<?php
/**
 *gestion des utilisateurs autorises
 */
// TODO mettre en place la protection et la gestion des users
class User
{
	private $matricule;
	private $nom;
	private $hash;

	/** @var odbUser model de gestion Bdd */
	private $odbUser;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		// on instancie les model
		$this->odbUser = new OdbUser();

		// // page actuelle
		// $_SESSION['tampon']['menu']['title'] = 'Utilisateur';
		// $_SESSION['tampon']['menu']['url'] = 'index.php?page=user&amp;action=adduser';
		// // liste des sous menus
		// $_SESSION['tampon']['sous_menu']['list'] =
		// 	array(
		// 			array('url'=>'index.php?page=user&amp;action=adduser',
		// 				'title'=>'Ajouter Utilisateur'),
		// 			array('url'=>'index.php?page=user&amp;action=unuser',
		// 				'title'=>'Un Utilisateur'),
		// 			array('url'=>'index.php?page=user&amp;action=rechercheruser' ,
		// 				'title'=>'Rechercher utilisateur'),
		// 		);

		// if (empty($_GET['action']))
		// 	$_GET['action'] = null;

		// /**
		//  * Switch de gestion des actions de User
		//  *
		//  * @param string $_GET['action'] contient l'action demmandee
		//  */
		// switch ($_GET['action']) {
		// 	case 'rechercheruser':
		// 		$this->rechercherUneUtilisateur();
		// 		break;
		// 	case 'unuser':
		// 		$this->afficherUnUtilisateur();
		// 		break;

		// 	case 'adduser':

		// 	default:
		// 		$this->afficherLesStations();
		// 		break;
		// }
	}

	public function __sleep()
	{
		return array('matricule', 'nom', 'hash');
	}

	public function __wakeup()
	{
		$this->odbUser = new OdbUser();
	}

	//////////////////////
	// Methodes public  //
	//////////////////////

	public function estUser()
	{
		// TODO verif du compte
		if(!empty($this->matricule))
			return true;
		// elseif ($this->login())
			return true;

		return false;
	}
	public function rechercherUneUtilisateur()
	{
		// TODO
		return false;
	}
	public function afficherUnUtilisateur()
	{
		// TODO
		return false;
	}
	public function afficherLesStations()
	{
		// TODO
		return false;
	}

	//////////////////////
	// Methodes privee //
	//////////////////////

	private function login()
	{
		if(!empty($_POST['nom']) and isset($_POST['mdp']))
			return $odbUser->checkHashUser(
				$_POST['nom'],
				hash('sha512',
					$_POST['nom'].$_POST['mdp'].$_POST['nom'])
				);
		return false;
	}
}
