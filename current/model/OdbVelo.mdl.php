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
					FROM velo
					WHERE Vel_Num = :codeVelo';

			$data = $this->oBdd->query($req , array('codeVelo'=>$codeVelo), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesVelosDeStation($codeStation){

		$req = 'SELECT *
				FROM etat
				INNER JOIN velo
					ON etat.Eta_Code = velo.Vel_Etat
				INNER JOIN produit
					ON velo.Vel_Type = produit.Pdt_Code
				WHERE Vel_Station = :codeStation';

		$lesVelos = $this->oBdd->query($req, array('codeStation'=>$codeStation));

		return $lesVelos;
	}

	public function getLesVelos(){

		$req = 'SELECT *
				FROM etat
				INNER JOIN velo
					ON etat.Eta_Code = velo.Vel_Etat
				INNER JOIN produit
					ON velo.Vel_Type = produit.Pdt_Code';

		$lesVelos = $this->oBdd->query($req);

		return $lesVelos;
	}

	public function getLesIdVelos(){

		$req = 'SELECT Vel_Num
				FROM etat
				INNER JOIN velo
					ON etat.Eta_Code = velo.Vel_Etat
				INNER JOIN produit
					ON velo.Vel_Type = produit.Pdt_Code
				ORDER BY Vel_Num DESC';

		$lesVelos = $this->oBdd->query($req);

		return $lesVelos;
	}

	public function getNouveauxVelos(){

		$req = 'SELECT *
				FROM etat
				INNER JOIN velo
					ON etat.Eta_Code = velo.Vel_Etat
				INNER JOIN produit
					ON velo.Vel_Type = produit.Pdt_Code
				ORDER BY Vel_Num DESC
				LIMIT 50';

		$lesVelos = $this->oBdd->query($req);

		return $lesVelos;
	}

	public function searchVelos($valeur)
	{
		$req = "SELECT *
				FROM etat
				INNER JOIN velo
					ON etat.Eta_Code = velo.Vel_Etat
				INNER JOIN produit
					ON velo.Vel_Type = produit.Pdt_Code
				WHERE
					Vel_Num LIKE :valeur
					OR Vel_Station LIKE :valeur";

		$lesStations = $this->oBdd->query($req, array('valeur'=>'%'.$valeur.'%'));

		return $lesStations;
	}

	public function getUnVelo($codeVelo){
		$req = 'SELECT *
				FROM etat
				INNER JOIN velo
					ON etat.Eta_Code = velo.Vel_Etat
				INNER JOIN produit
					ON velo.Vel_Type = produit.Pdt_Code
				WHERE Vel_Num = :codeVelo';

		$leVelo = $this->oBdd->query($req, array('codeVelo'=>$codeVelo), Bdd::SINGLE_RES);

		return $leVelo;
	}

	/**
	 * modifier certainens informations d'un velo et l'Etat
	 * @return int                nombre de ligne affectee
	 */
	public function modifierUnVelo(){

		$req = 'UPDATE velo
				SET Vel_Station     = :stationVelo,
					Vel_Etat        = :etatVelo,
					Vel_Accessoire  = :accessoireVelo
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
