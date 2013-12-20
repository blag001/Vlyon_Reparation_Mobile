<?php
/**
 * gestion des utilisateurs et de leurs droit d'accee
 * @todo mettre en place la gestion des user
 * @todo ajouter le remember-me
 */
class User
{
	private $id;
	private $matricule;
	private $nom;
	private $respAchat = false;

	/** @var odbUser model de gestion Bdd */
	private $odbUser;

	public function __construct($private = false)
	{
		/**
		 * On regarde si le user est connecte,
		 * si non, on lui affiche le formulaire de coo,
		 * et on termine le script
		 */
		if (!$private and !($_SESSION['user']->estUser())) {
			$_SESSION['user']->displayForm();
			die;
		}
		// si il est connecte
		// on instancie les model (lien avec la BDD)
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
		return array('id', 'matricule', 'nom', 'respAchat');
	}

	public function __wakeup()
	{
		$this->odbUser = new OdbUser();
	}

	////////////////////////////////
	// Methodes public du compte  //
	////////////////////////////////
	/**
	 * check si est un user
	 * @return [type] [description]
	 */
	public function estUser()
	{
		if(!empty($_GET['page']) and $_GET['page'] == 'logout')
			$this->logout();

		if(!empty($this->id))
			return true;
		elseif ($this->login())
			return true;

		return false;
	}
	/**
	 * affiche le formulaire de login
	 * @return [type] [description]
	 */
	public function displayForm()
	{
		view('htmlHeader');
		if(!empty($_SESSION['tampon']['error']))
			view('contentError');
		view('contentLogin');
		view('htmlFooter');
	}
	/**
	 * check si est technicient (et donc pas resp achat)
	 * @return [type] [description]
	 */
	public function estTechnicien()
	{
		if(!empty($this->matricule))
			if(!($this->respAchat))
				return true;

		return false;
	}
	/**
	 * va chercher le matricule
	 * @return int matricule de l'utilisateur
	 */
	public function getMatricule()
	{
		if(!empty($this->matricule))
				return $this->matricule;

		return false;
	}

	/////////////////////////////////////////////
	// Methodes public de gestion des comptes  //
	/////////////////////////////////////////////
	/**
	 * @todo a faire
	 * @return [type] [description]
	 */
	public function rechercherUnUtilisateur()
	{
		// TODO
		return false;
	}
	public function afficherUnUtilisateur()
	{
		// TODO
		return false;
	}
	public function afficherLesUtilissateurs()
	{
		// TODO
		return false;
	}

	//////////////////////
	// Methodes privee //
	//////////////////////
	/**
	 * va verifier si le mdp/is passe est bien prensent en bdd
	 *
	 * hash est une metode pour obtenir une emprinte unique
	 * ca nous evite de garder en clair les mdp, comme ca en
	 * cas de piratage, les mdp ne sont pas retrouvable simplement
	 *
	 * @return bool vrai si compte existe avec ce mdp/id, false sinon
	 */
	private function login()
	{
		// si on envois un nom et un mdp, alors on va faire les verif en bdd
		if(!empty($_POST['nom']) and isset($_POST['mdp']))
		{
			if($this->odbUser->checkHashUser($_POST['nom'],
				hash('sha512',
					$_POST['nom'].$_POST['mdp'].$_POST['nom'])))
			{
				$user = $this->odbUser->getUser($_POST['nom']);

				$this->id = $user->Use_Num;
				$this->matricule = $user->Use_Technicien;
				$this->nom = $user->Use_Nom;
				$this->respAchat = $user->Use_RespAchat;

				return true;
			}
			elseif ($this->odbUser->estUser($_POST['nom']))
				$_SESSION['tampon']['error'][] = 'Erreur sur le mot de passe.';
			else
				$_SESSION['tampon']['error'][] = 'Erreur sur l\'identifiant.';
		}

		return false;
	}
	/**
	 * permet au user de se deconnecter
	 * @return void
	 */
	private function logout()
	{
		// pour le moment on supporte pas le remember-me
		// if(isset($_COOKIE['remember_me']))
		// 	setcookie('remember_me', '', time()-1);

		$this->id = null;
		$this->matricule = null;
		$this->nom = null;
		$this->respAchat = null;
	}
}
