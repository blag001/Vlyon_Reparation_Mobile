<?php
/**
 * fichier de test du model des Produit
 */

	/**
	 * class de test de la gestion BDD des Produit
	 */
class OdbProduitTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->odbProduit = new OdbProduit();
	}

	//////////////
	// globale //
	//////////////

	public function testConnexionBddOk()
	{
		$out = $_SESSION['bdd']->query('SELECT 1 as nb', null, Bdd::SINGLE_RES);

		$this->assertEquals('1', $out->nb);
	}

		/**
		 * @depends testConnexionBddOk
		 */
	public function testInstanciationDuModel()
	{
		$this->assertTrue(is_object($this->odbProduit));

		$this->assertInstanceOf('OdbProduit', $this->odbProduit);
	}

	///////////////////
	// estProduit() //
	///////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstProduitFalseSiInexistant()
	{
		$this->assertFalse($this->odbProduit->estProduit('0'));
		$this->assertFalse($this->odbProduit->estProduit('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstProduitTrueSiExistant()
	{
		$this->assertTrue($this->odbProduit->estProduit('A'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstProduitFalseSiNullParam()
	{
		$this->assertFalse($this->odbProduit->estProduit());

		$this->assertFalse($this->odbProduit->estProduit(''));
	}

	//////////////////////
	// getLesProduit() //
	//////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeDeTousLesProduit()
	{
		$this->assertNotEmpty($this->odbProduit->getLesProduit());

		$this->assertInternalType('array', $this->odbProduit->getLesProduit());
	}
}
