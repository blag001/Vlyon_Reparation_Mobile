<?php
class OdbDemandeInter
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estDemandeInterById($code)
	{
		if(!empty($code))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM DEMANDEINTER
					WHERE DemI_Num = :code';

			$data = $this->oBdd->query($req , array('code'=>$code), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesDemandesInter()
	{
		$req = "SELECT *, DATE_FORMAT(DemI_Date, '%d/%m/%Y') AS DemI_Date
				FROM DEMANDEINTER";

		$lesDemandesInter = $this->oBdd->query($req);

		return $lesDemandesInter;
	}

	public function getUneDemandeInter($id)
	{
		$req = "SELECT *, DATE_FORMAT(DemI_Date, '%d/%m/%Y') AS DemI_Date
				FROM DEMANDEINTER, TECHNICIEN, STATION, VELO
				WHERE DemI_Num = :id
					AND DemI_Velo = Vel_Num
					AND Vel_Station = Sta_Code
					AND DemI_Technicien = Tec_Matricule";

		$laDemandeInter = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);

		return $laDemandeInter;
	}

	/**
	 * toutes les demandes d'intervention non traitees
	 * @return array tableau d'objet demande
	 */
	public function getLesDemandesNT()
	{
		$req = "SELECT *, DATE_FORMAT(DemI_Date, '%d/%m/%Y') AS DemI_Date
				FROM DEMANDEINTER, VELO, STATION
				WHERE DemI_Traite = 0
					AND DemI_Velo = Vel_Num
					AND Vel_Station = Sta_Code";

		$lesDemandesInter = $this->oBdd->query($req);

		return $lesDemandesInter;
	}

	
}
