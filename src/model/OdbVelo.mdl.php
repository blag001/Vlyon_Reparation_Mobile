<?php
/**
 * fichier de declaration du model des Velos
 */

	/**
	 * class de gestion BDD des Velos
	 */
class OdbVelo
{
		/** @var object objet Bdd */
	private $oBdd;

		/**
		 * contruteur du model
		 */
	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

		/**
		 * test si le code correspond a un velo
		 * @param  int $codeVelo code a tester
		 * @return bool           si est un velo ou non
		 */
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

		/**
		 * retourne les velo d'une station
		 * @param  int $codeStation le code de la station recherchee
		 * @return array              tableau d'object velo
		 */
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

		/**
		 * retourne tout les velos
		 * @return array tableau d'object velo
		 */
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

		/**
		 * retourne les 05 dernier velo ajoutes
		 * @return array tableau d'object velo
		 */
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

		/**
		 * recherche les velo
		 * @param  string $valeur la string a chercher
		 * @return array         tableau d'object velo
		 */
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

		/**
		 * retourne un velo via son code
		 * @param  int $codeVelo le code du velo
		 * @return object           le velo
		 */
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
	 * modifier les informations d'un velo et son Etat
	 * @return int                nombre de ligne affectee
	 */
	public function modifierUnVelo($stationVelo, $etatVelo, $accessoireVelo, $codeVelo){

		$req = 'UPDATE velo
				SET Vel_Station     = :stationVelo,
					Vel_Etat        = :etatVelo,
					Vel_Accessoire  = :accessoireVelo
				WHERE Vel_Num = :codeVelo';

		$out = $this->oBdd->exec($req, array(
				'stationVelo'    =>$stationVelo,
				'etatVelo'       =>$etatVelo,
				'accessoireVelo' =>$accessoireVelo,
				'codeVelo'       =>$codeVelo,
				));

		return $out;
	}
}
