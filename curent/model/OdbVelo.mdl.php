<?php
class OdbVelo{

	private $oBdd;
	private $odbEtats;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
		$this->odbEtats = new odbEtats();
	}

	public function getLesVelosDeStation($codeStation){

		$req = 'SELECT *
				FROM VELOS
				WHERE Vel_Station = :codeStation';
		$lesVelos = $this->oBdd->query($req, null, Bdd::FETCH_OBJ);

		return($lesVelos);
	}

	public function getUnVelo($codeVelo){
		$req = 'SELECT *
				FROM VELOS
				WHERE Vel_Code = :codeVelo';

		$leVelo = $this->oBdd->query($req, array('id'=>$id)
		return($leVelo);
	}

	//changer l'etat d'un velo
	public function recupererEtatVelo($codeVelo)
	{
		$req = 'SELECT Vel_Etat
				FROM VELOS
				WHERE Vel_Code = :codeVelo';

		$etat = $this->oBdd->query($req, array('id'=>$id)
		return($etat);

	}

	

	//modifier certainens informations d'un velo
	public function modifierUnVelo($codeVelo){

	}
}
