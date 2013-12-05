<?php
class OdbTechnicien
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estTechnicien(string $matricule)
	{
		if(!empty($matricule))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM TECHNICIEN
					WHERE Tech_Matricule = :matricule';
			$data = $oBdd->query($req, array('matricule'=>$matricule), Bdd::SINGLE_RES);
			return (bool) $data->nb;
		}
		return false;
	}

	public function getLesTechniciens()
	{
		$req = 'SELECT *
				FROM TECHNICIEN';
		$lesTechniciens = $oBdd->query($req);

		return $lesTechniciens;
	}

	public function getUnTechnicien($matricule)
	{
		$req = 'SELECT *
				FROM TECHNICIEN
				WHERE Tech_Matricule = :matricule';

		$leTechnicien = $oBdd->query($req, array('matricule'=>$matricule), Bdd::SINGLE_RES);
		return $leTechnicien;
	}

}
