<?php
/**
 *gestion des utilisateurs autorises
 */
// TODO mettre en place la protection et la gestion des users
class User
{
	private $matricule;
	private $hash;

	private $oNoSql;

	public function __construct()
	{
		$this->oNoSql = new Nosql();
	}

	public function estUser()
	{
		// TODO verif du compte
		return true;
	}
}
