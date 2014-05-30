<?php
/**
 * fichier de declaration du model d'Etat
 */

	/**
	 * class de gestion BDD des Etats
	 */
class OdbEtat
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
		 * test si l'id correspond a un etat
		 * @param  int $id l'id a tester
		 * @return bool     true/false si est ou non un etat
		 */
	public function estEtatById($id)
	{
		if(!empty($id))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM etat
					WHERE Eta_Code = :id';

			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

		/**
		 * retour les etat disponible
		 * @return array tableau d'objet des etats
		 */
	public function getLesEtats()
	{
		$req = 'SELECT *
				FROM etat';

		$lesEtats = $this->oBdd->query($req);

		return $lesEtats;
	}
}
