<?php
class OdbVelo{

	private $oNosql;

	public function __construct()
	{
		$this->oNosql = $_SESSION['nosql'];
	}

	public function estUser($matricule)
	{
		if(!empty($matricule))
			return $this->oNosql->query('user', $matricule);

		return false;
	}


	public function getHashUser($matricule){
		// retourne le mot de passe hashe (crypte)
		$leHashUser = $this->oNosql->query('user', $matricule, Nosql::GET_RESULT);

		return $leHashUser;
	}
}
