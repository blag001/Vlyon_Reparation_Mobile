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
			$req = "SELECT COUNT(*) AS nb
					FROM BONINTERV
					WHERE BI_Num = :code";

			$data = $this->oBdd->query($req , array('code'=>$code), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function estMonBonInter($code, $techCode)
	{
		if(!empty($code) and !empty($techCode))
		{
			$req = "SELECT COUNT(*) AS nb
					FROM BONINTERV
					WHERE BI_Num = :code
						AND BI_Technicien = :techCode";

			$data = $this->oBdd->query($req , array('code'=>$code, 'techCode'=>$techCode), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesBonsInter()
	{
		$req = "SELECT *,
					DATE_FORMAT(BI_DatDebut, '%d/%m/%Y') AS BI_DatDebut,
					DATE_FORMAT(BI_DatFin, '%d/%m/%Y') AS BI_DatFin
				FROM BONINTERV";

		$lesBonsInter = $this->oBdd->query($req);

		return $lesBonsInter;
	}

	public function getMonBonInter($code, $techCode)
	{
		$req = "SELECT *,
					DATE_FORMAT(BI_DatDebut, '%d/%m/%Y') AS BI_DatDebut,
					DATE_FORMAT(BI_DatFin, '%d/%m/%Y') AS BI_DatFin
				FROM BONINTERV
				WHERE BI_Num = :code
					AND BI_Technicien = :techCode";

		$leBonInter = $this->oBdd->query($req, array('code'=>$code, 'techCode'=>$techCode), Bdd::SINGLE_RES);

		return $leBonInter;
	}

	/**
	 * on visualise les interventions effectuees par un technicien gràce à son matricule
	 * @param  int $techCode matricule du technincient
	 * @return array           tableau d'objets
	 */
	public function getMesInterventions($techCode)
	{
		$req = "SELECT *,
					DATE_FORMAT(BI_DatDebut, '%d/%m/%Y') AS BI_DatDebut,
					DATE_FORMAT(BI_DatFin, '%d/%m/%Y') AS BI_DatFin
				FROM BONINTERV, VELO
				WHERE BI_Technicien = :techCode
					AND BI_Velo = Vel_Num";

		$lesBonsInter = $this->oBdd->query($req, array('techCode'=>$techCode));

		return $lesBonsInter;
	}

	/**
	 * on cree une intervention
	 * MAJ : normalement elle est OK, mais faut check...
	 */
	public function creerUnBonInter($code)
	{
		$req = 'INSERT INTO BONINTERV (
					 `BI_Num`,
					 `BI_Velo`,
					 `BI_DatDebut`,
					 `BI_DatFin`,
					 `BI_CpteRendu`,
					 `BI_Reparable`,
					 `BI_Demande`,
					 `BI_Technicien`,
					 `BI_SurPlace`,
					 `BI_Duree`
					)
				VALUES (
					 :code,
					 :veloCode,
					 :dateDebut,
					 :dateFin,
					 :cpteRendu,
					 :reparable,
					 :demande,
					 :technicienCode,
					 :surPlace,
					 :duree
				 	)';

		$out = $this->oBdd->exec($req, array(
				 'code'=>$code,
				 'veloCode'=>$_POST['veloCode'],
				 'dateDebut'=>$_POST['dateDebut'],
				 'dateFin'=>$_POST['dateFin'],
				 'cpteRendu'=>$_POST['cpteRendu'],
				 'reparable'=>$_POST['reparable'],
				 'demande'=>$_POST['demande'],
				 'technicienCode'=>$_POST['technicienCode'],
				 'surPlace'=>$_POST['surPlace'],
				 'duree'=>$_POST['duree'],
				));
		return $out;
	}
}
