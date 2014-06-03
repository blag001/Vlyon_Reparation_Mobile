<?php
/**
 * fichier de test du model des Velos
 */

	/**
	 * class de test de la gestion BDD des Velos
	 */
class OdbVeloTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->odbVelo = new OdbVelo();
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
		$this->assertTrue(is_object($this->odbVelo));

		$this->assertInstanceOf('OdbVelo', $this->odbVelo);
	}

	////////////////
	// estVelo() //
	////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstVeloFalseSiInexistant()
	{
		$this->assertFalse($this->odbVelo->estVelo('0'));
		$this->assertFalse($this->odbVelo->estVelo('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstVeloTrueSiExistant()
	{
		$this->assertTrue($this->odbVelo->estVelo('1'));

		$this->assertTrue($this->odbVelo->estVelo(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstVeloFalseSiNullParam()
	{
		$this->assertFalse($this->odbVelo->estVelo());

		$this->assertFalse($this->odbVelo->estVelo(''));
	}

	/////////////////////////////
	// getLesVelosDeStation() //
	/////////////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloVideSiStationInexistant()
	{
		$this->assertEmpty($this->odbVelo->getLesVelosDeStation('0'));
		$this->assertEmpty($this->odbVelo->getLesVelosDeStation('AZERTY'));
	}
		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloVideSiStationExistanteEtVeloAbsent()
	{
		$this->assertEmpty($this->odbVelo->getLesVelosDeStation('1023'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloSiStationExistanteEtVeloPresent()
	{
		$this->assertInternalType('array', $this->odbVelo->getLesVelosDeStation('1024'));

		$this->assertInternalType('array', $this->odbVelo->getLesVelosDeStation(1024));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloVideSiStationNullParam()
	{
		$this->assertEmpty($this->odbVelo->getLesVelosDeStation());

		$this->assertEmpty($this->odbVelo->getLesVelosDeStation(''));
	}


	////////////////////
	// getLesVelos() //
	////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeDeTousLesVelo()
	{
		$this->assertNotEmpty($this->odbVelo->getLesVelos());

		$this->assertInternalType('array', $this->odbVelo->getLesVelos());
	}


	/////////////////////////
	// getNouveauxVelos() //
	/////////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeDes50NouveauxLesVelo()
	{
		$this->assertNotEmpty($this->odbVelo->getNouveauxVelos());

		$this->assertInternalType('array', $this->odbVelo->getNouveauxVelos());

		$this->assertLessThanOrEqual(50, count($this->odbVelo->getNouveauxVelos()));
	}


	////////////////////
	// searchVelos() //
	////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloSiRechercheValide()
	{
			// vide
		$this->assertNotEmpty($this->odbVelo->searchVelos());
		$this->assertInternalType('array', $this->odbVelo->searchVelos());
			// un code velo
		$this->assertNotEmpty($this->odbVelo->searchVelos('7'));
			// un code station
		$this->assertNotEmpty($this->odbVelo->searchVelos('1024'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVideSiRechercheInvalide()
	{
		$this->assertEmpty($this->odbVelo->searchVelos('azerty'));
		$this->assertEmpty($this->odbVelo->searchVelos('99999'));
	}


	//////////////////
	// getUnVelo() //
	//////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneUnVeloSiCodeValide()
	{
		$this->assertNotEmpty($this->odbVelo->getUnVelo(1));

		$this->assertInternalType('object', $this->odbVelo->getUnVelo(1));

		$this->assertObjectHasAttribute('Vel_Num', $this->odbVelo->getUnVelo(1));
		$this->assertObjectHasAttribute('Eta_Code', $this->odbVelo->getUnVelo(1));
		$this->assertObjectHasAttribute('Pdt_Code', $this->odbVelo->getUnVelo(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourVideSiCodeVeloInvalide()
	{
		$this->assertEmpty($this->odbVelo->getUnVelo('azerty'));
		$this->assertEmpty($this->odbVelo->getUnVelo('0'));
	}


	///////////////////////
	// modifierUnVelo() //
	///////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testNeModifiePasDeVeloSiParamInvalide()
	{
		$this->assertEmpty($this->odbVelo->modifierUnVelo(0));
		$this->assertEmpty($this->odbVelo->modifierUnVelo(0, 0, 0));
		$this->assertEmpty($this->odbVelo->modifierUnVelo());
		$this->assertEmpty($this->odbVelo->modifierUnVelo('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 * @depends testRetourneUnVeloSiCodeValide
		 */
	public function testModifieUnVeloSiCodeValide()
	{
		$unVelo = $this->odbVelo->getUnVelo('1');

		if(empty($unVelo->Vel_Accessoire))
			$out = $this->odbVelo->modifierUnVelo( '1024', 1, 'panier', 1);
		else
			$out = $this->odbVelo->modifierUnVelo( '1024', 1, '', 1);

		$this->assertInternalType('integer', $out);
		$this->assertEquals(1, $out);
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testModificationNonRealiseeSiCodeVeloInvalide()
	{
		$this->assertEmpty($this->odbVelo->getUnVelo('azerty', 'azerty', 'azerty', 'azerty'));
		$this->assertEmpty($this->odbVelo->getUnVelo('0', '0', '0', '0'));
	}

}
