<?php
/**
 * ce fichier contient la déclaration de la class
 *
 * Si vous le renommez, pensez aussi à changer son appelle dans `index.php`
 */

	/**
	 * class de gestion de donnees en fichier
	 *
	 * Class pour une gestion simplifier de petite BDD noSql
	 * les terme son analogique mais traite
	 * - de dossiers (table)
	 * - et fichiers (entree)
	 *
	 * les entrees sont basee sur le model clef-valeur
	 * avec une contrainte d'unicitee sur la clef
	 * toutes les clefs sont stockee en base64
	 *
	 * @todo  Pensez a changer le CHMOD
	 *
	 * @method insert($table, $name, $data)
	 * @method query($table, $name[, $get_value])
	 * @method select_all($table[, $get_value])
	 * @method delete($table, $name)
	 * @method last_query()
	 * @method is_table($table)
	 * @method create($table)
	 * @method get_table($table)
	 * @method drop($table)
	 *
	 * @global boolean NO_RESULT
	 * @global boolean NO_ERASE
	 * @author Benoit <benoitelie1@gmail.com>
	 */
class Nosql
{
		/** @var string retour de la dernière query */
	private $last_query = false;
		/** @var string le chemain du workspace */
	private $path_db = 'nosql_db';
		/** @var integer le CHMOD des fichiers */
	private $chmod_file = 0666;
		/** @var integer le CHMOD des dossiers */
	private $chmod_dir = 0777;

		/** @var string url lors de l'instanciation de la class */
	private $callSource;

		/**
		 * constante pour NE PAS chercher la valeur
		 *
		 * Si vous l'utilisez, les methodes query()
		 * et select_all() vous ne vous retournerons
		 * que l'existance de l'entree, via un boolean.
		 *
		 * utilisez en dernier param de query/select_all "Nosql::NO_RESULT"
		 * la methode vous retourneras directement un bool
		 */
	const NO_RESULT = false;

		/**
		 * constante pour NE PAS ecraser les fichier
		 *
		 * Lors d'un Insert(), par defaut si le fichier existe,
		 * les donnees contenue serons perdue et remplace par $data
		 *
		 * utilisez en dernier param de insert "Nosql::NO_ERASE"
		 * la methode ajoutera les donnees a la fin du fichier
		 */
	const NO_ERASE = true;

	///////////////////
	// CONSTRUCTEUR //
	///////////////////

		/**
		 * instancie l'objet de connexion
		 * le workspaceBase est le dossier racine des tables
		 *
		 * @param string $workspaceBase
		 */
	public function __construct($workspaceBase = null)
	{

		if(!empty($workspaceBase))
			$this->path_db = $workspaceBase;

			// on sauve la page d'instanciation
		$this->callSource = $_SERVER['PHP_SELF'];
	}

	//////////////////////////////////////
	// fonction de gestion de la class //
	//////////////////////////////////////

		/**
		 * test le besoin de recharger la class nosql
		 *
		 * /!\ si vous changer $_SESSION['nosql'] par autre chose, pas exemple $_SESSION['oNoSql'],
		 * vous devez passer 'oNoSql' comme parametre de cette fonction
		 *
		 * @param  string $session_index l'index de $_SESSION ou se trouve l'objet NoSql ('nosql' par defaut)
		 * @return bool                true/false si oui ou non il faut une nouvelle instance
		 */
	public static function needInstance($session_index = 'nosql')
	{
		if(
			empty($_SESSION[$session_index])
			or !is_object($_SESSION[$session_index])
			or $_SESSION[$session_index]->getCallSource() !== $_SERVER['PHP_SELF']
			)
			return true;
		else
			return false;
	}

		/**
		 * getter de callSource
		 * @return string url d'instanciation de l'objet bdd en cours
		 */
	public function getCallSource(){
		return $this->callSource;
	}

		/**
		 * encode en base 64 perso ('/' en '-')
		 * @param  string $string une string a encoder
		 * @return string         la string encodé en base64
		 */
	private function _b64_e($string=''){
		return str_replace('/', '-', base64_encode($string));
	}

		/**
		 * decode depuis la base64 perso ('-' en '/')
		 * @param  string $string une string en base64
		 * @return string         la version decodé de la string
		 */
	private function _b64_d($string=''){
		return base64_decode(str_replace('-', '/', $string));
	}

	//////////////
	// REQUETE //
	//////////////

		/**
		 * insertion d'une key/value dans une table
		 *
		 * Par defaut si le fichier existe,
		 * les donnees contenue serons perdue et remplace par $data
		 *
		 * utilisez en dernier param la constante "Nosql::NO_ERASE" (ou TRUE)
		 * la methode ajoutera les donnees a la fin du fichier
		 *
		 * @param  string $table
		 * @param  string $key
		 * @param  string $data
		 * @param  boolean $no_erase
		 * @return int
		 */
	public function insert($table = null, $key = null , $data = null, $no_erase = false)
	{
		if($table != null and $this->is_table($table) and $data !== null and $key != null){
			if($no_erase)
				$ressource = @fopen($this->path_db.'/'.$table.'/'.$this->_b64_e($key), 'a');
			else
				$ressource = @fopen($this->path_db.'/'.$table.'/'.$this->_b64_e($key), 'w');

			if(!$ressource)
				die('ERROR : Le script ne peut ecrire le fichier "'.$this->path_db.'/'.$table.'/'.$this->_b64_e($key).'"');

			$output = fwrite($ressource, $data);
			fclose($ressource);
			chmod($this->path_db.'/'.$table.'/'.$this->_b64_e($key) , $this->chmod_file);

			return $output;
		}

		return false;
	}

		/**
		 * recherche by key dans une table
		 *
		 * Les valeurs ne sont pas renvoye si get_value a false
		 *
		 * @param  string  $table
		 * @param  string  $key
		 * @param  boolean $get_value
		 * @return string
		 */
	public function query($table = null, $key = null, $get_value = true)
	{
		if($table != null and $key != null and $this->is_table($table)){
			if(file_exists($this->path_db.'/'.$table.'/'.$this->_b64_e($key))){
				if($get_value)
					return $this->last_query = file_get_contents($this->path_db.'/'.$table.'/'.$this->_b64_e($key));
				else
					return true;
			}
		}

		return false;
	}

		/**
		 * recherche toutes les key dans une table
		 *
		 * Les valeurs ne sont pas renvoye si get_value a false
		 *
		 * @param  string  $table
		 * @param  boolean $get_value
		 * @return array
		 */
	public function select_all($table = null, $get_value = true)
	{
		$output = false;
		if($table != null and $this->is_table($table)){
			if($dir = opendir($this->path_db.'/'.$table)){
				while($file = readdir($dir)){
					if($file != '.' and $file != '..' and is_file($this->path_db.'/'.$table.'/'.$file)){
						if($get_value)
							$output[$this->_b64_d($file)] = file_get_contents($this->path_db.'/'.$table.'/'.$file);
						else
							$output[$this->_b64_d($file)] = true;
					}
				}
			}
		}

		return $output;
	}

		/**
		 * suppression d'une entree by key
		 *
		 * @param  string $table
		 * @param  string $key
		 * @return boolean
		 */
	public function delete($table=null, $key=null)
	{
		if($table !=null and $this->is_table($table)){
			if($key != null and file_exists($this->path_db.'/'.$table.'/'.$this->_b64_e($key))){
				if(unlink($this->path_db.'/'.$table.'/'.$this->_b64_e($key))){
					clearstatcache();

					return true;
				}
			}
		}

		return false;
	}

		/**
		 * derniere value retournee par query ou FALSE
		 *
		 * @return string
		 */
	public function last_query()
	{
		return $this->last_query;
	}

	////////////
	// TABLE //
	////////////

		/**
		 * verifie si on a bien a faire a une table
		 *
		 * @param  string  $table nom de la table
		 * @return boolean        true si table, false sinon
		 */
	public function is_table($table = null)
	{
		if($table != null)
			return is_dir($this->path_db.'/'.$table);
	}

		/**
		 * creer la table avec recursivite
		 *
		 * @param  string $table nom de la table
		 * @return bool        resultat de l'action
		 */
	public function create($table = null)
	{
		$output = false;

		if($table != null and !($this->is_table($table)) and !preg_match('#[^A-Za-z0-9/_]#', $table)){
			$output = mkdir($this->path_db.'/'.$table, $this->chmod_dir, true);
			chmod($this->path_db.'/'.$table , $this->chmod_dir);
		}

		return $output;
	}

		/**
		 * recherche toutes les sous-tables
		 *
		 * @param  string $table nom de la table
		 * @return array        tableau des tables
		 */
	public function get_table($table = null)
	{
		$output = false;

		if($table != null and $this->is_table($table)){
			if($dir = opendir($this->path_db.'/'.$table)){
				while($file = readdir($dir)){
					if($file != '.' and $file != '..' and is_dir($this->path_db.'/'.$table.'/'.$file))
						$output[] = $file;
				}
			}
		}

		return $output;
	}

		/**
		 * vide une table et la suprime
		 *
		 * @param  string $table nom de la table
		 * @return bool        resultat de l'action
		 */
	public function drop($table = null)
	{
		if($table != null and $this->is_table($table)){
			$no_error = true;

			if(($array = $this->select_all($table)) !== false)
				foreach($array as $key=>$value)
					$no_error &= $this->delete($table, $key);
					// And binaire : si un false on reste false

			if($no_error){
				$output = rmdir($this->path_db.'/'.$table);
				clearstatcache();

				return $output;
			}
		}

		return false;
	}
}
