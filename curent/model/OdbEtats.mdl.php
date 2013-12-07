<?php
class OdbEtats{

	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function getLesEtats()
	{
		$req = 'SELECT *
				FROM ETATS';

		$lesEtats = $this->oBdd->query($req);

		return $lesEtats;
	}
}
