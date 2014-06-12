<?php
/**
 * fichier de declaration du model des User
 */

	/**
	 * class de gestion BDD des Utilisateurs
	 */
class OdbUser
{
		/** @var object objet noSql */
	private $oNosql;
		/** @var object objet Bdd */
	private $oBdd;

		/**
		 * contruteur du model
		 */
	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
		$this->oNosql = $_SESSION['nosql'];
	}

		/**
		 * test si l'indentifiant existe dans la base
		 * @param  string $nom l'identifiant a tester
		 * @return bool      True/false si il existe ou non
		 */
	public function estUser($nom=null)
	{
		if(!empty($nom))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM user
					WHERE Use_Nom = :nom';

			$data = $this->oBdd->query($req , array('nom'=>$nom), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

		/**
		 * retour les information d'un utilisateur via on identifiant
		 * @param  string $nom l'identifiant de l'utilisateur a retourner
		 * @return object      l'utilisateur
		 */
	public function getUser($nom=null)
	{
		if(!empty($nom))
		{
			$req = 'SELECT *
					FROM user
					LEFT OUTER JOIN technicien
						ON user.Use_Technicien = technicien.Tec_Matricule
					WHERE Use_Nom = :nom';

			$data = $this->oBdd->query($req , array('nom'=>$nom), Bdd::SINGLE_RES);

			return $data;
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
	public function checkHashUser($nom=null, $hash=null)
	{
		if(!empty($nom) and !empty($hash))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM user
					WHERE Use_Nom = :nom
						AND Use_Hash = :hash';

			$data = $this->oBdd->query($req , array('nom'=>$nom, 'hash'=>$hash), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

		/**
		 * sauvegarde le jeton de reconnexion automatique (token) pour le "se souvenir de moi"
		 * @param  string $name  l'identifiant de l'utilisateur
		 * @param  string $token le token
		 * @return bool        si l'insertion s'est bien deroulee
		 */
	public function saveToken($name=null, $token=null)
	{
		if($name !== null and !empty($token))
		{
			if (!$this->oNosql->is_table('remember_me'))
				if(!$this->oNosql->create('remember_me'))
					return false;

			return $this->oNosql->insert('remember_me', $name, $token);
		}

		return false ;
	}

		/**
		 * supprime le token de reconnexion automatique
		 * @param  string $name l'identifiant du compte a deconecter
		 * @return bool       la reusite de la supression
		 */
	public function forgetToken($name=null)
	{
		if($name !== null)
			return $this->oNosql->delete('remember_me', $name);

		return false ;
	}

		/**
		 * retourne le token de reconnexion automatique
		 * @param  string $name l'identifiant du compte
		 * @return string       le token
		 */
	public function getToken($name=null)
	{
		if($name !== null)
			return $this->oNosql->query('remember_me', $name);

		return false ;
	}
}
