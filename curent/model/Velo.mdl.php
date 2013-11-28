<?php

class Velo{

	private $bdd = &$_SESSION['bdd'];

	public function getLesVelosDeStation($codeStation){

		$req = 'SELECT * 
				FROM VELOS 
				WHERE Vel_Station = :codeStation';
		$lesVelos = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return($lesVelos);
	}

	public function getUnVelo($codeVelo){
		$req = 'SELECT * 
				FROM VELOS
				WHERE Vel_Code = :codeVelo';

		$leVelo = $bdd->query($req, array('id'=>$id)
		return($leVelo);
	}

	public function modifierUnVelo{
		
	}
}