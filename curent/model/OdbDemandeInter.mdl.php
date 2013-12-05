<?php
class OdbDemandeInter
{
	// TODO : finir de rename les variables

	private $bdd;

	public function __construct()
	{
		$this->bdd = $_SESSION['bdd'];
	}

	public function estDemandeInter(string $nom)
	{
		if(!empty($nom))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM DEMANDEINTER
					WHERE Sta_Nom = :nom';

			$data = $bdd->query($req , array('nom'=>$nom), Bdd::SINGLE_RES);
			return (bool) $data;
		}
		return false;
	}

	public function getLesDemandesInter()
	{
		$req = 'SELECT *
				FROM DEMANDEINTER';
		$lesDemandesInter = $bdd->query($req);

		return $lesDemandesInter;
	}

	public function getUneDemandeInter($id)
	{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE Sta_Code = :id';

		$laDemandeInter = $bdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);
		return $laDemandeInter;
	}

	//visualiser toutes les demandes d'intervention non traitées
	public function getLesDemandesIT()
	{
		{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE DemI_Traite = 0';

		$lesDemandesInter = $bdd->query($req);
		return($lesDemandesInter);
	}

	}

}

