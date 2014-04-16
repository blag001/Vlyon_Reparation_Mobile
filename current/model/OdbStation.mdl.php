<?php
class OdbStation
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estStation($nom)
	{
		if(!empty($nom))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM station
					WHERE Sta_Nom = :nom';

			$data = $this->oBdd->query($req , array('nom'=>$nom), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function estStationById($id)
	{
		if(!empty($id))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM station
					WHERE Sta_Code = :id';

			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	public function getLesStations()
	{
		$req = 'SELECT *
				FROM station';

		$lesStations = $this->oBdd->query($req);

		return $lesStations;
	}

	public function getLesIdStations()
	{
		$req = 'SELECT Sta_Code
				FROM station';

		$lesStations = $this->oBdd->query($req);

		return $lesStations;
	}

	public function searchStations($valeur)
	{
		$req = "SELECT *
				FROM `station`
				WHERE `Sta_Code` LIKE :valeur
					OR `Sta_Nom` LIKE :valeur
					OR `Sta_Rue` LIKE :valeur";

		$lesStations = $this->oBdd->query($req, array('valeur'=>'%'.$valeur.'%'));

		return $lesStations;
	}

	public function getUneStation($id)
	{
		$req = 'SELECT *
				FROM station
				WHERE Sta_Code = :id';

		$laStation = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);

		return $laStation;
	}

	public function getNbVelosAttaches($station)
	{
		$req = 'SELECT COUNT(Vel_Code) AS nb
				FROM velo
				WHERE Vel_Station = :station';

		$nbVelo = $this->oBdd->query($req, array('station'=>$station), Bdd::SINGLE_RES);

		return $nbVelo->nb;
	}

	public function getNbVeloDispo($station){
		$req = 'SELECT COUNT(Vel_Code) AS nb
				FROM velo
				WHERE Vel_Station = :station
				AND Vel_Casse = 0';

		$nbVelo = $this->oBdd->query($req, array('station'=>$station), Bdd::SINGLE_RES);

		return $nbVelo->nb;
	}

	public function getNbAttachesDispo($station, $nbTotalAttaches){

		$nbVelosAttaches = $this->getNbVelosAttaches($station);

		$nbAttachesDispo = $nbTotalAttaches - $nbVelosAttaches;
		return $nbAttachesDispo;
	}

}

