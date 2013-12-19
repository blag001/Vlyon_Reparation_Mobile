<?php
class odbProduit{

	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estType($id)
	{
		if(!empty($id))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM PRODUIT
					WHERE Pdt_Code = :id';

			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesTypes()
	{
		$req = 'SELECT Pdt_Code, Pdt_Libelle
				FROM PRODUIT';

		$lesTypes = $this->oBdd->query($req);

		return $lesTypes;
	}
}
