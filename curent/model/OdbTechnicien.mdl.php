<?php
class OdbTechnicien
{
	private $bdd;

	public function __construct()
	{
		$this->bdd = $_SESSION['bdd'];
	}

	public function estTechnicien(string $matricule)
	{
		if(!empty($matricule))
		{
			$req = 'SELECT COUNT(*)
					FROM TECHNICIEN
					WHERE Tech_Matricule = :matricule';
			$nb = $bdd->query($req, array('matricule'=>$matricule));
			return (bool) $nb[0];
		}
		return false;
	}

	public function getLesTechniciens()
	{
		$req = 'SELECT *
				FROM TECHNICIEN';
		$lesTechniciens = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return $lesTechniciens;
	}

	public function getUnTechnicien($matricule)
	{
		$req = 'SELECT *
				FROM TECHNICIEN
				WHERE Tech_Matricule = :matricule'

		$laStation = $bdd->query($req, array('matricule'=>$matricule));
		return($laStation);
	}

}
