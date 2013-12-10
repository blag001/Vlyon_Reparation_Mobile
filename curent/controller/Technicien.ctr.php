<?php
class Technicien
{
	/** @var OdbTechnicien model de gestion Bdd */
	private $odbTechnicien;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		// on instancie les model
		$this->odbTechnicien = new OdbTechnicien();

		// page actuelle
		$_SESSION['tampon']['page']['title'] = 'Technicien';
		$_SESSION['tampon']['page']['url'] = 'index.php?page=technicien';

		if (empty($_GET['action']))
			$_GET['action'] = null;

		/**
		 * Switch de gestion des actions de Technicien
		 *
		 * @param string $_GET['action'] contient l'action demmandee
		 */
		switch ($_GET['action']) {
			default:
				$this->showEmpty();
				break;
		}
	}


	/**
	 * affiche du vide
	 * @return void
	 */
	protected function showEmpty()
	{
		$_SESSION['tampon']['title'] = 'Tous Les Techniciens';
		view('htmlHeader');
		view('htmlFooter');
	}

}
