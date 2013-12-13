<?php
/**
 *gestion des utilisateurs autorises
 */
// TODO mettre en place la protection et la gestion des users
class User
{
	private $matricule;
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

		// page actuelle
		$_SESSION['tampon']['menu']['title'] = 'Utilisateur';
		$_SESSION['tampon']['menu']['url'] = 'index.php?page=user&amp;action=adduser';
		// liste des sous menus
		$_SESSION['tampon']['sous_menu']['list'] =
			array(
					array('url'=>'index.php?page=user&amp;action=adduser',
						'title'=>'Ajouter Utilisateur'),
					array('url'=>'index.php?page=user&amp;action=unuser',
						'title'=>'Un Utilisateur'),
					array('url'=>'index.php?page=user&amp;action=rechercheruser' ,
						'title'=>'Rechercher utilisateur'),
				);

		if (empty($_GET['action']))
			$_GET['action'] = null;

		/**
		 * Switch de gestion des actions de User
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
		switch ($_GET['action']) {
			case 'rechercheruser':
				$this->rechercherUneUtilisateur();
				break;
			case 'unuser':
				$this->afficherUnUtilisateur();
				break;

			case 'adduser':

			default:
				$this->afficherLesStations();
				break;
		}
	}

	public function estUser()
	{
		// TODO verif du compte
		return true;
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

}
