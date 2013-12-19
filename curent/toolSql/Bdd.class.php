<?php
/**
 * class de gestion PDO simplifiee
 *
 * @method {mixed} query() query(string $sql, array $arg, bool $mono_line) lance une recherche
 * 	qui attend un ou plusieurs resultats (retour en obj ou array d'obj)
 * @method {int} exec() exec(string $sql, array $arg) execute une commande et
 * 	retourne le nb de lignes affectees
 *
 * @global boolean SINGLE_RES
 * @author Benoit <benoitelie1@gmail.com>
 */
class Bdd
{
	// valeur par defaut en cas d'instanciation sans valeur
	private $host    = 'localhost';
	private $db_name = 'sio_reparation';
	private $user    = 'root';
	private $mdp     = '';

	/** @var PDO variable avec l'instance PDO */
	private $oBdd  = null;

	/**
	 * constante en cas de resultat unique
	 *
	 * Si vous savez que vous allez avoir un seul resultat
	 * (par ex, un COUNT(*), un getUn...() )
	 * utilisez en 3eme param de query "Bdd::SINGLE_RES"
	 * la methode vous retourneras directement un objet
	 */
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
			// save des var
		if(!empty($host))
			$this->host = $host;
		if(!empty($db_name))
			$this->db_name = $db_name;
		if(!empty($user))
			$this->user = $user;
		if(!empty($mdp))
			$this->mdp = $mdp;

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
	 * passe le mode de recherche en retour object
	 * utilise l'UTF8 pour les transactions
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
	 * Passe les requetes avec ou sans variable
	 *
	 * Expoite a la fois les query et les prepare de PDO
	 * retourne soit un objet si $mono_line a true,
	 * soit un array d'objet si false/null
	 *
	 * On lui passe la requete SQL avec les marqueurs.
	 * 	un marqueur est une string avec ':' devant
	 * 		ex : 'SELECT * FROM Table WHERE Tab_code = :mon_marqueur '
	 * On lui donne les arguments dans un tableau.
	 * 	l'array doit etre associatif marqueur => valeur
	 * 		ex : 'array('mon_marqueur' => $codeTable)'
	 *
	 * Si vous savez que vous allez avoir un seul resultat
	 * (par ex, un COUNT(*), un getUn...() )
	 * utilisez en 3eme param "Bdd::SINGLE_RES" (ou TRUE)
	 * la methode vous retourneras directement un objet
	 *
	 * @param  string  $sql
	 * @param  array  $arg
	 * @param  boolean $mono_line
	 * @return mixed
	 */
	public function query($sql, array $arg = null, $mono_line = false)
	{
		// on regarde si on a des variable dans les arguments
		if(!empty($arg))
		{
			// on prepare la requete SQL
			$req = $this->oBdd->prepare($sql);
			// on l'execute avec les variables
			$req->execute($arg);
		}
		else
		{
			// on fait une query simple
			$req = $this->oBdd->query($sql);
		}

		// si on demande une monoligne, simple fetch
		if($mono_line)
			$data = $req->fetch();
		else // sinon on cherche tout les obj en array
			$data = $req->fetchAll();

		// on ferme la requete en cours
		$req->closeCursor();

		return $data;
	}

	/**
	 * execute une requete SQL
	 *
	 * On lui passe la requete SQL avec les marqueurs.
	 * 	un marqueur est une string avec ':' devant
	 * 		ex : 'DELETE FROM Table WHERE Tab_code = :mon_marqueur '
	 * 		ex : 'DELETE FROM Table WHERE Tab_val > :marqueur1 AND Tab_type = :marqueur2 '
	 * on lui donne les arguments dans un tableau.
	 * 	l'array doit etre associatif marqueur => valeur
	 * 		ex : 'array('mon_marqueur' => $codeTable)'
	 * 		ex2 : 'array('marqueur1' => $clause1, 'marqueur2'=>$clause2)'
	 *
	 * retourne le nombre de ligne affectee
	 *
	 * @param  string $sql
	 * @param  array $arg
	 * @return int
	 */
	public function exec($sql, array $arg = null)
	{
		// on regarde si on a des variable dans les arguments
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
