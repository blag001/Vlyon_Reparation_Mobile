<?php


class Station
{
	/*
	private int $id;
	private String $nom;
	private String $numeroRue;
	private String $nomRue;
	private String $coPos;
	private String $ville;
	private int $nbVelosAttaches;
	private int $nbVelosDispo;
	private int $nbAttachesDispo;
	*/

	// pointeur vers la variable en session (alias)
	private $bdd = $_SESSION['bdd'];

	public bool estStation(string $nom)
	{
		if(!empty($nom))
		{
			$nb = $bdd->query('SELECT COUNT(*) FROM STATION WHERE Sta_Nom = :nom' , array('nom'=>$nom));
			return (bool) $nb[0];
		}
		return false;
	}

	public function getLesStations()
	{
		$req = 'SELECT *
				FROM STATION';
		$lesStations = $bdd->query($req, null, Bdd::FETCH_OBJ);

		return $lesStations;
	}

	public function getUneStation($id)
	{
		$req = 'SELECT *
				FROM STATION
				WHERE Sta_Code = :id'

		$laStation = $bdd->query($req, array('id'=>$id));
		return($laStation);
	}

	public function getNbVelosAttaches($station)
	{
		$req = 'SELECT COUNT(Vel_Code)
				FROM VELO
				WHERE Vel_Station = :station'

		$nbVelo = $bdd->query($req, array('station'=>$station));
		return $nbVelo[0];
	}

	public function getNbVeloDispo($station){
		$req = 'SELECT COUNT(Vel_Code)
				FROM VELO
				WHERE Vel_Station = :station
				AND Vel_Casse = 0';
		$nbVelo = $bdd->query($req, array('station'=>$station));
		return $nbVelo[0];
	}

	public function getNbAttachesDispo($station, $nbTotalAttaches){

		$nbVelosAttaches = getNbVelosAttaches($station);

		$nbAttachesDispo = $nbTotalAttaches - $nbVelosAttaches;
		return $nbAttachesDispo;
	}






	/*public String getId() {
		return(id);
	}

	public String getNom() {
		return(nom);
	}

	public String getNumeroRue() {

	}

	public String getNomRue() {

	}

	public String getCoPos() {

	}

	public String getVille() {

	}

	public String get {

	}

	public String get {

	}

	public String get {

	}

	public String get {

	}*/



}

