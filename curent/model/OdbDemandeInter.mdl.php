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
			$req = 'SELECT COUNT(*)
					FROM DEMANDEINTER
					WHERE Sta_Nom = :nom';
			$nb = $bdd->query($req , array('nom'=>$nom));
			return (bool) $nb[0];
		}
		return false;
	}

	public function getLesDemandesInter()
	{
		$req = 'SELECT *
				FROM DEMANDEINTER';
		$lesDemandesInter = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return $lesDemandesInter;
	}

	public function getUneDemandeInter($id)
	{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE Sta_Code = :id'

		$laDemandeInter = $bdd->query($req, array('id'=>$id));
		return($laDemandeInter);
	}

	//visualiser toutes les demandes d'intervention non traitées
	public function visualiserDINT()
	{
		{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE DemI_Traite = 0'

		$lesDemandesInter = $bdd->query($req, null, Bdd::FETCH_OBJ);
		return($lesDemandesInter);
	}

	}

}

