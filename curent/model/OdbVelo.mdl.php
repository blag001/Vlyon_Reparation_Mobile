<?php
class OdbVelo{

	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estVelo($codeVelo)
	{
		if(!empty($codeVelo))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM VELO
					WHERE Vel_Num = :codeVelo';

			$data = $this->oBdd->query($req , array('codeVelo'=>$codeVelo), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesVelosDeStation($codeStation){

		$req = 'SELECT *
				FROM VELO, ETAT, PRODUIT
				WHERE Vel_Station = :codeStation
					AND VELO.Vel_Etat = ETAT.Eta_Code
					AND VELO.Vel_Type = PRODUIT.Pdt_Code';

		$lesVelos = $this->oBdd->query($req, array('codeStation'=>$codeStation));

		return $lesVelos;
	}

	public function getNouveauxVelos(){

		$req = 'SELECT *
				FROM VELO, ETAT, PRODUIT
				WHERE VELO.Vel_Etat = ETAT.Eta_Code
					AND VELO.Vel_Type = PRODUIT.Pdt_Code
				ORDER BY Vel_Num DESC
				LIMIT 50';

		$lesVelos = $this->oBdd->query($req);

		return $lesVelos;
	}

	public function searchVelos($valeur)
	{
		$req = "SELECT *
				FROM VELO, ETAT, PRODUIT
				WHERE
					(
						Vel_Num LIKE :valeur
						OR Vel_Station LIKE :valeur
					)
					AND VELO.Vel_Etat = ETAT.Eta_Code
					AND VELO.Vel_Type = PRODUIT.Pdt_Code";

		$lesStations = $this->oBdd->query($req, array('valeur'=>'%'.$valeur.'%'));

		return $lesStations;
	}

	public function getUnVelo($codeVelo){
		$req = 'SELECT *
				FROM VELO, ETAT, PRODUIT
				WHERE Vel_Num = :codeVelo
					AND VELO.Vel_Etat = ETAT.Eta_Code
					AND VELO.Vel_Type = PRODUIT.Pdt_Code';

		$leVelo = $this->oBdd->query($req, array('codeVelo'=>$codeVelo), Bdd::SINGLE_RES);

		return $leVelo;
	}

	/**
	 * modifier certainens informations d'un velo et l'Etat
	 * @return int                nombre de ligne affectee
	 */
	public function modifierUnVelo(){

		$req = 'UPDATE VELO
				SET Vel_Station     = :stationVelo,
					Vel_Etat        = :etatVelo,
					Vel_Accessoire  = :accessoireVelo,
				WHERE Vel_Num = :codeVelo';

		$out = $this->oBdd->exec($req, array(
				'stationVelo'    =>$_POST['stationVelo'],
				'etatVelo'       =>$_POST['etatVelo'],
				'accessoireVelo' =>$_POST['accessoireVelo'],
				'codeVelo'       =>$_POST['codeVelo'],
				));

		return $out;
	}
}
