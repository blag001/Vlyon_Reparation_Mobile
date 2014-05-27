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
					FROM boninterv
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
					FROM boninterv
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
				FROM boninterv";

		$lesBonsInter = $this->oBdd->query($req);

		return $lesBonsInter;
	}

	public function getMonBonInter($code, $techCode)
	{
		$req = "SELECT *,
					DATE_FORMAT(BI_DatDebut, '%d/%m/%Y') AS BI_DatDebut,
					DATE_FORMAT(BI_DatFin, '%d/%m/%Y') AS BI_DatFin
				FROM boninterv
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
				FROM boninterv
				INNER JOIN velo
					ON boninterv.BI_Velo = velo.Vel_Num
				WHERE BI_Technicien = :techCode";

		$lesBonsInter = $this->oBdd->query($req, array('techCode'=>$techCode));

		return $lesBonsInter;
	}

		/**
		 * on va chercher la derniere intervention
		 */
	public function getIdLastIntervention()
	{
		$req = "SELECT BI_Num
				FROM boninterv
				ORDER BY BI_Num DESC
				LIMIT 1";

		$lesBonsInter = $this->oBdd->query($req, null, Bdd::SINGLE_RES);

		return $lesBonsInter->BI_Num;
	}

		/**
		 * on cree une intervention
		 * @return int nb de ligne sauvee
		 */
	public function creerUnBonInter($Vel_Num, $dateDebut, $dateFin, $cpteRendu, $reparable, $code_demande, $matTech, $surPlace, $duree)
	{
		$req = 'INSERT INTO boninterv (
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
					 :Vel_Num,
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
				 'Vel_Num'=>$Vel_Num,
				 'dateDebut'=>$dateDebut,
				 'dateFin'=>$dateFin,
				 'cpteRendu'=>$cpteRendu,
				 'reparable'=>$reparable,
				 'demande'=>$code_demande,
				 'technicienCode'=>$matTech,
				 'surPlace'=>$surPlace,
				 'duree'=>$duree,
				));
		return $out;
	}

	public function searchMesBonIntervention($valeur, $techCode)
	{
		$req = "SELECT *
				FROM `boninterv`
				WHERE
					(
						`BI_Num` LIKE :valeur
						OR `BI_Velo` LIKE :valeur
						OR `BI_Demande` LIKE :valeur
					)
					AND BI_Technicien = :techCode"
					;

		$lesBonsInter = $this->oBdd->query($req, array('valeur'=>'%'.$valeur.'%', 'techCode'=>$techCode));

		return $lesBonsInter;
	}
}
