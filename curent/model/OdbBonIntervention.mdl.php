<?php
class BonInterv
{
	// TODO : finir de rename les variables
	private $bdd = $_SESSION['bdd'];

	public function estBonInter(string $code)
	{
		if(!empty($code))
		{
			$req = 'SELECT COUNT(*)
					FROM BONINTERV
					WHERE BI_Num = :code';
			$nb = $bdd->query($req , array('nom'=>$code));
			return (bool) $nb[0];
		}
		return false;
	}

	public function getLesBonsInter()
	{
		$req = 'SELECT *
				FROM BONINTERV';
		$lesBonsInter = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return $lesBonsInter;
	}

	public function getUnBonInter($code)
	{
		$req = 'SELECT *
				FROM BONINTERV
				WHERE BI_Num = :code';

		$leBonInter = $bdd->query($req, array('code'=>$code));
		return($leBonInter);
	}

	//on visualise les interventions effectuées par un technicien gràce à son matricule
	public function getSesInterventions($techCode)
	{
		$req = 'SELECT *
				FROM BONINTERV
				WHERE BI_Technicien = :techCode';
		$lesBonsInter = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return $lesBonsInter;

	}
}
