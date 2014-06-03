<?php
/**
 * fichier de test du model des Technicien
 */

	/**
	 * class de test de la gestion BDD des Technicien
	 */
class OdbTechnicienTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->odbTechnicien = new OdbTechnicien();
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
		$this->assertTrue(is_object($this->odbTechnicien));

		$this->assertInstanceOf('OdbTechnicien', $this->odbTechnicien);
	}

	//////////////////////
	// estTechnicien() //
	//////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstTechnicienFalseSiInexistant()
	{
		$this->assertFalse($this->odbTechnicien->estTechnicien('0'));
		$this->assertFalse($this->odbTechnicien->estTechnicien('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstTechnicienTrueSiExistant()
	{
		$this->assertTrue($this->odbTechnicien->estTechnicien(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstTechnicienFalseSiNullParam()
	{
		$this->assertFalse($this->odbTechnicien->estTechnicien());

		$this->assertFalse($this->odbTechnicien->estTechnicien(''));
	}

	//////////////////////////
	// getLesTechniciens() //
	//////////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeDeTousLesTechnicien()
	{
		$this->assertNotEmpty($this->odbTechnicien->getLesTechniciens());

		$this->assertInternalType('array', $this->odbTechnicien->getLesTechniciens());
	}


	////////////////////////
	// getUnTechnicien() //
	////////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneUnTechnicienSiMatriculeValide()
	{
		$this->assertNotEmpty($this->odbTechnicien->getUnTechnicien(1));

		$this->assertInternalType('object', $this->odbTechnicien->getUnTechnicien(1));

		$this->assertObjectHasAttribute('Tec_Matricule', $this->odbTechnicien->getUnTechnicien(1));
		$this->assertObjectHasAttribute('Tec_Nom', $this->odbTechnicien->getUnTechnicien(1));
		$this->assertObjectHasAttribute('Tec_Prenom', $this->odbTechnicien->getUnTechnicien(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourVideSiMatriculeTechnicienInvalide()
	{
		$this->assertEmpty($this->odbTechnicien->getUnTechnicien('azerty'));
		$this->assertEmpty($this->odbTechnicien->getUnTechnicien('0'));
	}
}
