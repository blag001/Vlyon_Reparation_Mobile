<?php
class OdbTechnicien
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estTechnicien($matricule)
	{
		if(!empty($matricule))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM technicien
					WHERE Tech_Matricule = :matricule';

			$data = $oBdd->query($req, array('matricule'=>$matricule), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesTechniciens()
	{
		$req = 'SELECT *
				FROM technicien';

		$lesTechniciens = $oBdd->query($req);

		return $lesTechniciens;
	}

	public function getUnTechnicien($matricule)
	{
		$req = 'SELECT *
				FROM technicien
				WHERE Tech_Matricule = :matricule';

		$leTechnicien = $oBdd->query($req, array('matricule'=>$matricule), Bdd::SINGLE_RES);

		return $leTechnicien;
	}
}
