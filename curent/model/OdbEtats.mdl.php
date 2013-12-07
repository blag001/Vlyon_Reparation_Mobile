<?php
class OdbEtats{

	private $oBdd;

	public function __construct()
	{
		$this->bdd = $_SESSION['bdd'];
	}

	public function getLesEtats()
	{
		$req = 'SELECT *
				FROM ETATS';
		$lesEtats = $this->oBdd->query($req, null, Bdd::FETCH_OBJ);

		return($lesEtats);
	}

	public function blabla(){

	}

}
