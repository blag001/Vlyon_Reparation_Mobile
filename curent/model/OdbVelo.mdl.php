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
				FROM VELO, ETAT
				WHERE Vel_Station = :codeStation
					AND VELO.Vel_Etat = ETAT.Eta_Code';

		$lesVelos = $this->oBdd->query($req, array('codeStation'=>$codeStation));

		return $lesVelos;
	}

	public function getUnVelo($codeVelo){
		$req = 'SELECT *
				FROM VELO, ETAT
				WHERE Vel_Num = :codeVelo
					AND VELO.Vel_Etat = ETAT.Eta_Code';

		$leVelo = $this->oBdd->query($req, array('codeVelo'=>$codeVelo), Bdd::SINGLE_RES);

		return $leVelo;
	}

	//modifier certainens informations d'un velo et l'Etat
	/**
	 * @todo j'ai un doute sur l'utilisation des ->query pour les update...
	 *       donc je check ça quand j'ai le temps :P
	 */
	public function modifierUnVelo($arrayDataVelo){

		$req = 'UPDATE VELO
				SET Vel_Station     = :stationVelo,
					Vel_Etat        = :stationVelo,
					Vel_Type        = :typeVelo,
					Vel_Accessoire  = :accessoireVelo,
					Vel_Casse       = :veloCasse
				WHERE Vel_Num = :codeVelo';

		$leVelo = $this->oBdd->query($req, $aarrayDataVelo);

		return $leVelo;
	}
}
