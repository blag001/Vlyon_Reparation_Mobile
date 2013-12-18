<?php
class odbProduit{

	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function getLesTypes()
	{
		$req = 'SELECT Pdt_Code, Pdt_Libelle
				FROM PRODUIT';

		$lesTypes = $this->oBdd->query($req);

		return $lesTypes;
	}
}
