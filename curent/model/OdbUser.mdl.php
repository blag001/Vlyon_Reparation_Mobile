<?php
class OdbUser{

	private $oNosql;

	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

	public function estUser($nom)
	{
		if(!empty($nom))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM USER
					WHERE Use_Nom = :nom';

			$data = $this->oBdd->query($req , array('nom'=>$nom), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

	/**
	 * verifie que le mot de passe est bon
	 *
	 * prend un hash du mot de passe,
	 * le nom de l'utilisateur,
	 * et cherche une entree qui valides les deux
	 *
	 * @param  string $nom  le nom du user
	 * @param  string $hash le hash du mdp user
	 * @return bool       valide ou non l'existance
	 */
	public function checkHashUser($nom, $hash)
	{
		if(!empty($nom) and !empty($hash))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM USER
					WHERE Use_Nom = :nom
						AND Use_Hash = :hash';

			$data = $this->oBdd->query($req , array('nom'=>$nom, 'hash'=>$hash), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}
}
