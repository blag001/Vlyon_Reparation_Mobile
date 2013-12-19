<?php
class odbEtat{

	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estEtatById($id)
	{
		if(!empty($id))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM ETAT
					WHERE Eta_Code = :id';

			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesEtats()
	{
		$req = 'SELECT *
				FROM ETAT';

		$lesEtats = $this->oBdd->query($req);

		return $lesEtats;
	}
}
