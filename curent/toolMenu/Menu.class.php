<?php
	/**
	 * class de gestion PDO simplifiee
	 *
	 * @method {mixed} query(string $sql[, array $arg[, bool $mono_line]]) lance une recherche
	 * 	       qui attend un ou plusieurs resultats (retour en objet ou array d'objet)
	 * @method {int} exec(string $sql[, array $arg]) execute une commande et
	 * 	       retourne le nombre de lignes affectees
	 *
	 * @global boolean SINGLE_RES
	 * @author Benoit <benoitelie1@gmail.com>
	 */
class Menu
{
	private $menu;

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
	public function __construct( &$menu)
	{
			// save des variable si on en passe au constructeur
		if(!empty($menu))
			$this->menu = &$menu;
	}

		/**
		 * variable a sauver a la fin du chargement de page
		 *
		 * @return array
		 */
	public function __sleep()
	{
		return array();
	}


	//////////////
	// PRIVATE //
	//////////////


	/////////////
	// PUBLIC //
	/////////////

	public function getListMenu($level=0)
	{
		if(isset($this->menu[$level]['list']) and is_array($this->menu[$level]['list']))
			return $this->menu[$level]['list'];
		else
			return array();
	}

	public function getCurrentMenu($level=0)
	{
		if(isset($this->menu[$level]['current'])
			and is_array($this->menu[$level]['list'])
			and array_key_exists($this->menu[$level]['current'], $this->menu[$level]['list'])
			)
		{
			return array(
				'url' => $this->menu[$level]['list'][ $this->menu[$level]['current'] ],
				'title' => $this->menu[$level]['current'],
				);
		}
		else
			return array('url' => '','title' => '');
	}

	public function isCurrentMenu($level=0, $title=null)
	{
		if(
			$title != null
			and isset($this->menu[$level]['current'])
			and $this->menu[$level]['current'] == $title
			)
			return true;
		else
			return false;
	}


}
