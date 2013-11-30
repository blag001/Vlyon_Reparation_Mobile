<?php
/**
 * class de gestion de donnees en fichier
 *
 * Class pour une gestion simplifier de petite BDD
 * les terme son analogique mais traite de dossiers et fichiers
 *
 * @method insert($table, $name, $data)
 * @method query($table, $name, $get_value)
 * @method select_all($table, $get_value)
 * @method delet($table, $name)
 * @method last_query()
 * @method is_table($table)
 * @method create($table)
 * @method get_table($table)
 * @method drop($table)
 *
 * @author benoit elie
 */
class Nosql
{

	private $last_query;
	private $path_db;
	private $chmod_file = 0666;
	private $chmod_dir = 0777;

	//**************//
	// CONSTRUCTEUR //
	//**************//
		// new Nosql( [string 'chemin_du_dossier_de_stockage'] )
	public function __construct($path = 'nosql')
	{
		$this->last_query = false;
		$this->path_db = $path;
	}

	//*********//
	// REQUETE //
	//*********//
		// insertion d'une key/value dans une table
	public function insert($table = null, $name = null , $data = null)
	{
		if($table != null and $data != null and $this->is_table($table))
		{
			$output = file_put_contents($this->path_db.'/'.$table.'/'.base64_encode($name) , $data, FILE_APPEND);
			chmod($this->path_db.'/'.$table.'/'.base64_encode($name) , $this->chmod_file);
			return $output;
		}
		return false;
	}
		// recherche by key dans une table
	public function query($table = null, $name = null, $get_value = true)
	{
		if($table != null and $name != null and $this->is_table($table))
			if(file_exists($this->path_db.'/'.$table.'/'.base64_encode($name)))
				if($get_value)
					return $this->last_query = file_get_contents($this->path_db.'/'.$table.'/'.base64_encode($name));
				else
					return true;
		return false;
	}
		// recherche toutes les key dans une table (avec leur value si $get_value == true)
	public function select_all($table = null, $get_value = false)
	{
		$output = false;
		if($table != null and $this->is_table($table))
		{
			if($dir = opendir($this->path_db.'/'.$table))
			{
				$i = 0;
				while($file = readdir($dir))
				{
					if($file != '.' and $file != '..' and is_file($this->path_db.'/'.$table.'/'.$file))
					{
						$output[$i]['key'] = base64_decode($file);
						if($get_value)
							$output[$i]['value'] = file_get_contents($this->path_db.'/'.$table.'/'.$file);
						$i++;
					}
				}
			}
		}
		return $output;
	}
		// suppression d'une entree by key
	public function delet($table=null, $name=null)
	{
		if($this->is_table($table) and $table !=null)
			if(file_exists($this->path_db.'/'.$table.'/'.base64_encode($name)) and $name != null)
				if(unlink($this->path_db.'/'.$table.'/'.base64_encode($name)))
				{
					clearstatcache();
					return true;
				}
		return false;
	}
		// derniere value retournee par query ou FALSE
	public function last_query()
	{
		return $this->last_query;
	}
	//*******//
	// TABLE //
	//*******//
		// check si on a bien a faire a une table
	public function is_table($table = null)
	{
		if($table != null)
			return is_dir($this->path_db.'/'.$table);
	}
		// creer la table avec recursivite
	public function create($table = null)
	{
		$output = false;
		if($table != null and !($this->is_table($table)) and !preg_match('#[^A-Za-z0-9/_]#', $table))
		{
			$output = mkdir($this->path_db.'/'.$table, $this->chmod_dir, true);
			chmod($this->path_db.'/'.$table , $this->chmod_dir);
		}
		return $output;
	}
		// recherche toutes les sous-tables
	public function get_table($table = null)
	{
		$output = false;
		$i = 0;
		if($table != null and $this->is_table($table))
		{
			if($dir = opendir($this->path_db.'/'.$table))
			{
				while($file = readdir($dir))
				{
					if($file != '.' and $file != '..' and is_dir($this->path_db.'/'.$table.'/'.$file))
					{
						$output[$i] = $file;
						$i++;
					}
				}
			}
		}
		return $output;
	}
		// vide la table et la suprime
	public function drop($table = null)
	{
		if($table != null and $this->is_table($table))
		{
			$no_error = true;
			if(($array = $this->select_all($table)) !== false)
				foreach($array as $value)
					$no_error &= $this->delet($table, $value['key']); // And binaire : si un false on reste false
			if($no_error)
			{
				$output = rmdir($this->path_db.'/'.$table);
				clearstatcache();
				return $output;
			}
		}
		return false;
	}
}
