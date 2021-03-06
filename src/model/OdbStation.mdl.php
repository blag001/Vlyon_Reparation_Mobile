<?php
/**
 * fichier de declaration du model des stations
 */

	/**
	 * class de gestion BDD des Stations
	 */
class OdbStation
{
		/** @var object objet Bdd */
	private $oBdd;

		/**
		 * contruteur du model
		 */
	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

		/**
		 * test si le nom correspond bien a une station
		 * @param  string $nom le nom a tester
		 * @return bool      si est oui ou non une station
		 */
	public function estStation($nom=null)
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

		/**
		 * test si l'id correspond bien a une station
		 * @param  int $id l'id a tester
		 * @return bool     si est oui ou non une station
		 */
	public function estStationById($id=null)
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

		/**
		 * retourne les stations
		 * @return array tableau d'object station
		 */
	public function getLesStations()
	{
		$req = 'SELECT *
				FROM station';

		$lesStations = $this->oBdd->query($req);

		return $lesStations;
	}

		/**
		 * retourne les ID des differentes stations
		 * @return array tableau des id
		 */
	public function getLesIdStations()
	{
		$req = 'SELECT Sta_Code
				FROM station';

		$lesStations = $this->oBdd->query($req);

		return $lesStations;
	}

		/**
		 * recheche une station via une string
		 * @param  string $valeur la string a chercher
		 * @return array         tableau d'object station
		 */
	public function searchStations($valeur=null)
	{
		$req = "SELECT *
				FROM `station`
				WHERE `Sta_Code` LIKE :valeur
					OR `Sta_Nom` LIKE :valeur
					OR `Sta_Rue` LIKE :valeur";

		$lesStations = $this->oBdd->query($req, array('valeur'=>'%'.$valeur.'%'));

		return $lesStations;
	}

		/**
		 * retourne une station via son ID
		 * @param  int $id l'id de la station à retourner
		 * @return object     la station
		 */
	public function getUneStation($id=null)
	{
		$req = 'SELECT *
				FROM station
				WHERE Sta_Code = :id';

		$laStation = $this->oBdd->query($req, array('id'=>$id), Bdd::SINGLE_RES);

		return $laStation;
	}

		/**
		 * retourne le nombre de velo attache a une station
		 * @param  int $station le code de la station
		 * @return int          le nombre de velo
		 */
	public function getNbVelosAttaches($station=null)
	{
		$req = 'SELECT COUNT(Vel_Code) AS nb
				FROM velo
				WHERE Vel_Station = :station';

		$nbVelo = $this->oBdd->query($req, array('station'=>$station), Bdd::SINGLE_RES);

		return $nbVelo->nb;
	}

		/**
		 * retourne le nombre de velo disponible sur une station
		 * @param  int $station le code de la station
		 * @return int          le nombre de velo disponible
		 */
	public function getNbVeloDispo($station=null){
		$req = 'SELECT COUNT(Vel_Code) AS nb
				FROM velo
				WHERE Vel_Station = :station
				AND Vel_Casse = 0';

		$nbVelo = $this->oBdd->query($req, array('station'=>$station), Bdd::SINGLE_RES);

		return $nbVelo->nb;
	}

}

