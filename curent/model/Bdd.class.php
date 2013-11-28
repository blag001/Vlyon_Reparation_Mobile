<?php
class Bdd
{
	private $host    = 'localhost';
	private $db_name = 'reparation';
	private $user    = 'root';
	private $mdp     = '';

	private $oBdd  = null;

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
			$this->oBdd = PDO::__construct(
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
	public function query(string $sql, array $arg)
	{
		if(!empty($arg))
		{
			// on prepare la requete
			$req = $this->oBdd->prepare($sql);
			// on l'execute
			$req->execute($arg);
			return $req->fetchAll();
		}
		else
		{
			// on fait une query simple
			$datas = $this->oBdd->query($sql);
			return $req->fetchAll();
		}
	}
	// fonction d'execute
	public function execute(string $sql)
	{
		return $this->oBdd->execute($sql);
	}

}
