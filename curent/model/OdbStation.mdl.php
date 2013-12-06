<?php
class OdbStation
{
	private $oBdd;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estStation(string $nom)
	{
		if(!empty($nom))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM STATION
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
					FROM STATION
					WHERE Sta_Code = :id';
			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);
			// var_dump($nb);
			return (bool) $data->nb;
		}
		return false;
	}

	public function getLesStations()
	{
		$req = 'SELECT *
				FROM STATION';
		$lesStations = $this->oBdd->query($req);

		return $lesStations;
	}

	public function getUneStation($id)
	{
		$req = 'SELECT *
				FROM STATION
				WHERE Sta_Code = :id';

		$laStation = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);
		// var_dump($laStation);
		return $laStation;
	}

	public function getNbVelosAttaches($station)
	{
		$req = 'SELECT COUNT(Vel_Code) AS nb
				FROM VELO
				WHERE Vel_Station = :station';

		$nbVelo = $this->oBdd->query($req, array('station'=>$station), Bdd::SINGLE_RES);
		return $nbVelo->nb;
	}

	public function getNbVeloDispo($station){
		$req = 'SELECT COUNT(Vel_Code) AS nb
				FROM VELO
				WHERE Vel_Station = :station
				AND Vel_Casse = 0';
		$nbVelo = $this->oBdd->query($req, array('station'=>$station), Bdd::SINGLE_RES);
		return $nbVelo->nb;
	}

	public function getNbAttachesDispo($station, $nbTotalAttaches){

		$nbVelosAttaches = getNbVelosAttaches($station);

		$nbAttachesDispo = $nbTotalAttaches - $nbVelosAttaches;
		return $nbAttachesDispo;
	}

}
