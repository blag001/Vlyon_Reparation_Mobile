<?php
class OdbVelo{

	private $oBdd;
	private $odbEtats;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
		$this->odbEtats = new OdbEtats();
	}

	public function getLesVelosDeStation($codeStation){

		$req = 'SELECT *
				FROM VELOS
				WHERE Vel_Station = :codeStation';
		$lesVelos = $this->oBdd->query($req, array('codeStation'=>$codeStation));

		return $lesVelos;
	}

	public function getUnVelo($codeVelo){
		$req = 'SELECT *
				FROM VELOS
				WHERE Vel_Code = :codeVelo';

		$leVelo = $this->oBdd->query($req, array('codeVelo'=>$codeVelo), Bdd::SINGLE_RES);
		return $leVelo;
	}

	/*public function recupererEtatVelo($codeVelo)
	{
		$req = 'SELECT Vel_Etat
				FROM VELOS
				WHERE Vel_Code = :codeVelo';

		$etat = $this->oBdd->query($req, array('codeVelo'=>$codeVelo)
		return($etat);

	}*/

	//modifier certainens informations d'un velo et l'Etat
	public function modifierUnVelo($codeVelo, $stationVelo, $etatVelo, $typeVelo, $accessoireVelo, $veloCasse){

		$req = 'UPDATE VELO
				SET Vel_Station = :stationVelo, Vel_Etat = :stationVelo, Vel_Type = :typeVelo, Vel_Accessoire = :accessoireVelo, Vel_Casse = :veloCasse
				WHERE Vel_Num = :codeVelo';

		$leVelo = $this->oBdd->query($req, array('codeVelo'=>$codeVelo));
		return($leVelo);
	}
}
