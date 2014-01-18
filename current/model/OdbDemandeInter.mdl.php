<?php
class OdbDemandeInter
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estDemandeInter($code)
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
					AND DEMANDEINTER.DemI_Velo = VELO.Vel_Num
					AND VELO.Vel_Station = STATION.Sta_Code
					AND DEMANDEINTER.DemI_Technicien = TECHNICIEN.Tec_Matricule";

		$laDemandeInter = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);

		return $laDemandeInter;
	}

	public function getIdVeloByIdDemandeInter($id)
	{
		$req = "SELECT DemI_Velo AS Vel_Num
				FROM DEMANDEINTER
				WHERE DemI_Num = :id";

		$laDemandeInter = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);

		return $laDemandeInter->Vel_Num;
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
					AND DEMANDEINTER.DemI_Velo = VELO.Vel_Num
					AND VELO.Vel_Station = STATION.Sta_Code";

		$lesDemandesInter = $this->oBdd->query($req);

		return $lesDemandesInter;
	}

	public function creerUneDemande()
	{
		$req = 'INSERT INTO DEMANDEINTER (
					 `DemI_Velo`,
					 `DemI_Date`,
					 `DemI_Technicien`,
					 `DemI_Motif`,
					 `DemI_Traite`
					)
				VALUES (
					 :Vel_Num,
					 :dateDemande,
					 :technicienCode,
					 :cpteRendu,
					 :traite
				 	)';

		$out = $this->oBdd->exec($req, array(
				 'Vel_Num'=>$_POST['Vel_Num'],
				 'dateDemande'=>$_POST['dateDemande'],
				 'technicienCode'=>$_SESSION['user']->getMatricule() ,
				 'cpteRendu'=>$_POST['cpteRendu'],
				 'traite'=>$_POST['traite'],
				));
		return $out;
	}

}
