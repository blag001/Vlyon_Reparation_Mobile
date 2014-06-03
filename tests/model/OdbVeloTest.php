<?php
/**
 * fichier de test du model des Velos
 */

	/**
	 * class de test de la gestion BDD des Velos
	 */
class OdbVeloTest extends PHPUnit_Framework_TestCase
{
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
		$odbVelo = new OdbVelo();

		$this->assertTrue(is_object($odbVelo));

		$this->assertInstanceOf('OdbVelo', $odbVelo);
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
		$odbVelo = new OdbVelo();

		$this->assertFalse($odbVelo->estVelo('0'));
		$this->assertFalse($odbVelo->estVelo('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstVeloTrueSiExistant()
	{
		$odbVelo = new OdbVelo();

		$this->assertTrue($odbVelo->estVelo('1'));

		$this->assertTrue($odbVelo->estVelo(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstVeloFalseSiNullParam()
	{
		$odbVelo = new OdbVelo();

		$this->assertFalse($odbVelo->estVelo());

		$this->assertFalse($odbVelo->estVelo(''));
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
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->getLesVelosDeStation('0'));
		$this->assertEmpty($odbVelo->getLesVelosDeStation('AZERTY'));
	}
		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloVideSiStationExistanteEtVeloAbsent()
	{
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->getLesVelosDeStation('1023'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloSiStationExistanteEtVeloPresent()
	{
		$odbVelo = new OdbVelo();

		$this->assertInternalType('array', $odbVelo->getLesVelosDeStation('1024'));

		$this->assertInternalType('array', $odbVelo->getLesVelosDeStation(1024));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVeloVideSiStationNullParam()
	{
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->getLesVelosDeStation());

		$this->assertEmpty($odbVelo->getLesVelosDeStation(''));
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
		$odbVelo = new OdbVelo();

		$this->assertNotEmpty($odbVelo->getLesVelos());

		$this->assertInternalType('array', $odbVelo->getLesVelos());
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
		$odbVelo = new OdbVelo();

		$this->assertNotEmpty($odbVelo->getNouveauxVelos());

		$this->assertInternalType('array', $odbVelo->getNouveauxVelos());

		$this->assertLessThanOrEqual(50, count($odbVelo->getNouveauxVelos()));
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
		$odbVelo = new OdbVelo();
			// vide
		$this->assertNotEmpty($odbVelo->searchVelos());
		$this->assertInternalType('array', $odbVelo->searchVelos());
			// un code velo
		$this->assertNotEmpty($odbVelo->searchVelos('7'));
			// un code station
		$this->assertNotEmpty($odbVelo->searchVelos('1024'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneListeVideSiRechercheInvalide()
	{
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->searchVelos('azerty'));
		$this->assertEmpty($odbVelo->searchVelos('99999'));
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
		$odbVelo = new OdbVelo();

		$this->assertNotEmpty($odbVelo->getUnVelo(1));

		$this->assertInternalType('object', $odbVelo->getUnVelo(1));

		$this->assertObjectHasAttribute('Vel_Num', $odbVelo->getUnVelo(1));
		$this->assertObjectHasAttribute('Eta_Code', $odbVelo->getUnVelo(1));
		$this->assertObjectHasAttribute('Pdt_Code', $odbVelo->getUnVelo(1));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourVideSiCodeVeloInvalide()
	{
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->getUnVelo('azerty'));
		$this->assertEmpty($odbVelo->getUnVelo('0'));
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
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->modifierUnVelo(0));
		$this->assertEmpty($odbVelo->modifierUnVelo(0, 0, 0));
		$this->assertEmpty($odbVelo->modifierUnVelo());
		$this->assertEmpty($odbVelo->modifierUnVelo('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 * @depends testRetourneUnVeloSiCodeValide
		 */
	public function testModifieUnVeloSiCodeValide()
	{
		$odbVelo = new OdbVelo();

		$unVelo = $odbVelo->getUnVelo('1');

		if(empty($unVelo->Vel_Accessoire))
			$out = $odbVelo->modifierUnVelo( '1024', 1, 'panier', 1);
		else
			$out = $odbVelo->modifierUnVelo( '1024', 1, '', 1);

		$this->assertInternalType('integer', $out);
		$this->assertEquals(1, $out);
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testModificationNonRealiseeSiCodeVeloInvalide()
	{
		$odbVelo = new OdbVelo();

		$this->assertEmpty($odbVelo->getUnVelo('azerty', 'azerty', 'azerty', 'azerty'));
		$this->assertEmpty($odbVelo->getUnVelo('0', '0', '0', '0'));
	}

}
