<?php
/**
 * class de gestion PDO simplifiee
 *
 * @global boolean SINGLE_RES
 * @author Benoit <benoitelie1@gmail.com>
 */
class Bdd
{
	private $host    = 'localhost';
	private $db_name = 'sio_reparation';
	private $user    = 'root';
	private $mdp     = 'tioneb';

	/** @var PDO variable avec l'instance PDO */
	private $oBdd  = null;

	/** constante en cas de resultat unique */
	const SINGLE_RES = true;

	////////////////////
	// CONSTRUCTEUR  //
	////////////////////
	/**
	 * cree une instance PDO avec les valeurs en argument
	 *
	 * @param string $host
	 * @param string $db_name
	 * @param string $user
	 * @param string $mdp
	 */
	public function __construct($host=false, $db_name=false, $user=false, $mdp=false)
	{
		if($host && $db_name && $user && $mdp)
		{
			// save des var
			$this->host    = $host;
			$this->db_name = $db_name;
			$this->user    = $user;
			$this->mdp     =  $mdp;
		}

		$this->connexion();
	}

	/**
	 * variable a sauver a la fin du chargement de page
	 *
	 * @return array
	 */
	public function __sleep()
	{
		return array('host', 'db_name', 'user', 'mdp');
	}
	/**
	 * on reconnect au load de la page
	 */
	public function __wakeup()
	{
		$this->connexion();
	}

	//////////////
	// PRIVATE //
	//////////////
	/**
	 * cree une instance PDO
	 *
	 * @return void
	 */
	protected function connexion()
	{
		try{
			// on appelle le constructeur POD
			$this->oBdd = new PDO(
				'mysql:host='.$this->host.';dbname='.$this->db_name,
				$this->user,
				$this->mdp
				);
			// on set les options a utilise
			$this->oBdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$this->oBdd->exec("SET CHARACTER SET utf8");
		}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
		}
	}

	/////////////
	// PUBLIC //
	/////////////
	/**
	 * passe les requetes avec ou sans variable
	 *
	 * expoite a la fois les query et les prepare de PDO
	 * retourne soit un objet si mono_line a true,
	 * soit un array d'objet si false/null
	 *
	 * @param  string  $sql
	 * @param  array  $arg
	 * @param  boolean $mono_line
	 * @return mixed
	 */
	public function query($sql, array $arg = null, $mono_line = false)
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

		if($mono_line)
			$data = $req->fetch();
		else
			$data = $req->fetchAll();

		// on ferme la requete en cours
		$req->closeCursor();

		return $data;
	}

	/**
	 * execute une requete SQL
	 *
	 * retourne le nombre de ligne affectee
	 *
	 * @param  string $sql
	 * @return int
	 */
	public function exec(string $sql, array $arg = null)
	{
		if(!empty($arg))
		{
			// on prepare la requete
			$req = $this->oBdd->prepare($sql);
			// on l'execute
			if($out = $req->execute($arg))
				// si pas de pb, on compte le nb ligne affectee
				$out = $req->rowCount();

			// on ferme la requete en cours
			$req->closeCursor();
		}
		else
			$out = $this->oBdd->exec($sql);

		return $out;
	}
}
