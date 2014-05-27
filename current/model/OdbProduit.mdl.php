<?php
/**
 * fichier de declaration du model de Produit
 */

	/**
	 * class de gestion BDD des Produits
	 * @todo  inutilise pour le moment
	 */
class odbProduit
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
		 * test si l'id correspond bien a un produit
		 * @param  string $id le code du produit
		 * @return bool     si oui ou non est bien un produit
		 */
	public function estProduit($id)
	{
		if(!empty($id))
		{
			$req = 'SELECT COUNT(*) AS nb
					FROM produit
					WHERE Pdt_Code = :id';

			$data = $this->oBdd->query($req , array('id'=>$id), Bdd::SINGLE_RES);

			return (bool) $data->nb;
		}

		return false;
	}

		/**
		 * retourne les produits
		 * @return array tableau d'object produit
		 */
	public function getLesProduit()
	{
		$req = 'SELECT Pdt_Code, Pdt_Libelle
				FROM produit';

		$lesTypes = $this->oBdd->query($req);

		return $lesProduit;
	}
}
