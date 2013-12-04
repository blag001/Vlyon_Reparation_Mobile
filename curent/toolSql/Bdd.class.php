<?php
class Bdd
{
	private $host    = 'localhost';
	private $db_name = 'reparation';
	private $user    = 'root';
	private $mdp     = '';

	private $oBdd  = null;

	const FETCH_OBJ = true;

	//**************//
	// CONSTRUCTEUR //
	//**************//
		// retourne une instance PDO avec les valeur par def
	public function __construct()
	{
		$this->connexion();
	}
		// retourne une instance PDO avec les valeur en argument
	public function __construct($host, $db_name, $user, $mdp)
	{
		// save des var
		$this->host    = $host;
		$this->db_name = $db_name;
		$this->user    = $user;
		$this->mdp     =  $mdp;

		$this->connexion();
	}

	//**************//
	//    PRIVATE   //
	//**************//
		// cree une instance PDO
	protected function connexion()
	{
		try{
			// on appelle le constructeur POD
			$this->oBdd = new PDO(
				'mysql:host='.$this->host.';dbname='.$this->db_name,
				$this->user,
				$this->mdp,
				);
			// on set les option a utilise
			$this->oBdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->oBdd->exec("SET CHARACTER SET utf8");
		}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
		}
	}

	//**************//
	//    PUBLIC    //
	//**************//

	// passe les requetes avec ou sans variable
	public function query(string $sql, array $arg = null, $mode_objet = false)
	{
		if(!empty($arg))
		{
			// on prepare la requete
			$req = $this->oBdd->prepare($sql);
			// on l'execute
			$req->execute($arg);
		}
		else
		{
			// on fait une query simple
			$req = $this->oBdd->query($sql);
		}

		if($mode_objet)
			return $this->objInArray($req);
		else
			return $req->fetchAll();
	}
	// fonction d'execute
	public function execute(string $sql)
	{
		return $this->oBdd->execute($sql);
	}

	//**************//
	//   PRIVATE    //
	//**************//

	private function objInArray($pointeur)
	{
		$array = array();
		if (!empty($pointeur)) {
			while ($data = $pointeur->fetch(PDO::FETCH_OBJ)) {
				$array[] = $data;
			}
		}

		return $array;
	}
}