<?php
class Bdd
{
	private $host    = 'localhost';
	private $db_name = 'reparation';
	private $user    = 'root';
	private $mdp     = '';

	private $objBdd  = null;

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
		$this->host = $host;
		$this->db_name = $db_name;
		$this->user = $user;
		$this->mdp = $mdp;

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
			$this->objBdd = PDO::__construct(
				'mysql:host='.$this->host.';dbname='.$this->db_name,
				$this->user,
				$this->mdp,
				);
			// on set les option a utilise
			$this->objBdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->objBdd->exec("SET CHARACTER SET utf8");
		}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
		}
	}

	//**************//
	//    PUBLIC    //
	//**************//

	// passe les requetes avec ou sans variable
	public function query(string $sql, array $arg)
	{
		if(!empty($arg))
		{
			// on prepare la requete
			$req = $this->objBdd->prepare($sql);
			// on l'execute
			$req->execute($arg);
		}
		else
		{
			// on fait une query simple
			$datas = $this->objBdd->query($sql);
		}
	}

}
