<?php
class odbEtat{

	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function getLesEtats()
	{
		$req = 'SELECT *
				FROM ETAT';

		$lesEtats = $this->oBdd->query($req);

		return $lesEtats;
	}
}
