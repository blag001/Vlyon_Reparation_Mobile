<?php
class DemandeInter
{
	// TODO : finir de rename les variables
	private $bdd = $_SESSION['bdd'];
	
	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login	
		}
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
		$lesStations = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return $lesStations;
	}

	public function getUneDemandeInter($id)
	{
		$req = 'SELECT *
				FROM DEMANDEINTER
				WHERE Sta_Code = :id'

		$laStation = $bdd->query($req, array('id'=>$id));
		return($laStation);
	}

}

