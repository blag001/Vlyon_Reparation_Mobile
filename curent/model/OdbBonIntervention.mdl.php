<?php
/**
 * @todo  @method creerUnBonInter => a revoir...
 */
class OdbBonIntervention
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estBonInter($code)
	{
		if(!empty($code))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM BONINTERV
					WHERE BI_Num = :code';

			$data = $this->oBdd->query($req , array('code'=>$code), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesBonsInter()
	{
		$req = 'SELECT *
				FROM BONINTERV';

		$lesBonsInter = $this->oBdd->query($req);

		return $lesBonsInter;
	}

	public function getUnBonInter($code)
	{
		$req = 'SELECT *
				FROM BONINTERV
				WHERE BI_Num = :code
					AND BI_Technicien = Tec_Matricule';

		$leBonInter = $this->oBdd->query($req, array('code'=>$code), Bdd::SINGLE_RES);

		return $leBonInter;
	}

	//on visualise les interventions effectuees par un technicien gràce à son matricule
	public function getSesInterventions($techCode)
	{
		$req = 'SELECT *
				FROM BONINTERV, STATION
				WHERE BI_Technicien = :techCode
					AND BI_Station = Sta_Num';

		$lesBonsInter = $this->oBdd->query($req);

		return $lesBonsInter;
	}

	//on cree une intervention
	/**
	 * @todo pas de variable dans les requetes...
	 *       on passe tout avec des marqueur et un tableau
	 */
	public function creerUnBonInter($code)
	{
		// $req = 'INSERT INTO BONINTERV
		// 		VALUES ('$code', '$veloCode', '$dateDebut', '$dateFin', '$cpteRendu', '$reparable', '$demande', '$technicienCode', '$surPlace', '$duree' )
		// 		WHERE BI_Num = :code';

		// $leBonInter = $bdd->query($req, array('code'=>$code));
		// return($leBonInter);
	}


}
