<?php
/**
 * fichier de test du model des Etat
 */

	/**
	 * class de test de la gestion BDD des Etat
	 */
class OdbEtatTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->odbEtat = new OdbEtat();
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
		$this->assertTrue(is_object($this->odbEtat));

		$this->assertInstanceOf('OdbEtat', $this->odbEtat);
	}

	////////////////////
	// estEtatById() //
	////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstEtatFalseSiInexistant()
	{
		$this->assertFalse($this->odbEtat->estEtatById('0'));
		$this->assertFalse($this->odbEtat->estEtatById('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstEtatTrueSiExistant()
	{
		$this->assertTrue($this->odbEtat->estEtatById('1'));

		$this->assertTrue($this->odbEtat->estEtatById(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstEtatFalseSiNullParam()
	{
		$this->assertFalse($this->odbEtat->estEtatById());

		$this->assertFalse($this->odbEtat->estEtatById(''));
	}

	////////////////////
	// getLesEtats() //
	////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeDeTousLesEtat()
	{
		$this->assertNotEmpty($this->odbEtat->getLesEtats());

		$this->assertInternalType('array', $this->odbEtat->getLesEtats());
	}
}
