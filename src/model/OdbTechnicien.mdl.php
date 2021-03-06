<?php
/**
 * fichier de declaration du model des Technicien
 */

	/**
	 * class de gestion BDD des Technicien
	 */
class OdbTechnicien
{
		/** @var object objet Bdd */
	private $oBdd;

		/**
		 * contruteur du model
		 */
	public function __construct()
	{
		$this->oBdd = $_SESSION['bdd'];
	}

		/**
		 * test le matricule est bien lie a un techncien
		 * @param  int $matricule le matricule a tester
		 * @return bool            si oui ou non et bien un technicien
		 */
	public function estTechnicien($matricule=null)
	{
		if(!empty($matricule))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM technicien
					WHERE Tec_Matricule = :matricule';

			$data = $this->oBdd->query($req, array('matricule'=>$matricule), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

		/**
		 * retourne les techniciens
		 * @return array tableau d'oject technicien
		 */
	public function getLesTechniciens()
	{
		$req = 'SELECT *
				FROM technicien';

		$lesTechniciens = $this->oBdd->query($req);

		return $lesTechniciens;
	}

		/**
		 * retourne les info d'un technicien
		 * @param  int $matricule le matricule du technicien a retourner
		 * @return object            l'objet technicien
		 */
	public function getUnTechnicien($matricule=null)
	{
		$req = 'SELECT *
				FROM technicien
				WHERE Tec_Matricule = :matricule';

		$leTechnicien = $this->oBdd->query($req, array('matricule'=>$matricule), Bdd::SINGLE_RES);

		return $leTechnicien;
	}
}
