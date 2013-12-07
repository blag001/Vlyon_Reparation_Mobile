<?php
class OdbDemandeInter
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estDemandeInter($nom)
	{
		if(!empty($nom))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM DEMANDEINTER
					WHERE Sta_Nom = :nom';

			$data = $this->oBdd->query($req , array('nom'=>$nom), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function estDemandeInterById($id)
	{
		if(!empty($id))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM DEMANDEINTER
					WHERE Sta_Code = :id';

			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesDemandesInter()
	{
		$req = 'SELECT *
				FROM DEMANDEINTER';

		$lesDemandesInter = $this->oBdd->query($req);

		return $lesDemandesInter;
	}

	public function getUneDemandeInter($id)
	{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE Sta_Code = :id';

		$laDemandeInter = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);

		return $laDemandeInter;
	}

	// toutes les demandes d'intervention non traitees
	public function getLesDemandesNT()
	{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE DemI_Traite = 0';

		$lesDemandesInter = $this->oBdd->query($req);

		return $lesDemandesInter;
	}
}
