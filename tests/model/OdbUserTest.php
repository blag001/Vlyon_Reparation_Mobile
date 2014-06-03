<?php
/**
 * fichier de test du model des User
 */

	/**
	 * class de test de la gestion BDD des User
	 */
class OdbUserTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->odbUser = new OdbUser();
	}

	//////////////
	// globale //
	//////////////

	public function testConnexionBddOk()
	{
		$out = $_SESSION['bdd']->query('SELECT 1 as nb', null, Bdd::SINGLE_RES);

		$this->assertEquals('1', $out->nb);
	}

	public function testConnexionNosqlOk()
	{
		if (!$_SESSION['nosql']->is_table('testPhpUnit')){
			$this->assertTrue($_SESSION['nosql']->create('testPhpUnit'));
			$this->assertTrue( (bool)$_SESSION['nosql']->insert('testPhpUnit', 'test', '1') );
			$this->assertTrue( (bool)$_SESSION['nosql']->query('testPhpUnit', 'test') );

			$this->assertTrue($_SESSION['nosql']->drop('testPhpUnit'));
		}
		else{
			$this->assertTrue( (bool)$_SESSION['nosql']->insert('testPhpUnit', 'test', '1') );
			$this->assertTrue( (bool)$_SESSION['nosql']->query('testPhpUnit', 'test') );

			$this->assertTrue($_SESSION['nosql']->delete('testPhpUnit', 'test'));
		}
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testConnexionNosqlOk
		 */
	public function testInstanciationDuModel()
	{
		$this->assertTrue(is_object($this->odbUser));

		$this->assertInstanceOf('OdbUser', $this->odbUser);
	}

	////////////////
	// estUser() //
	////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstUserFalseSiInexistant()
	{
		$this->assertFalse($this->odbUser->estUser('0'));
		$this->assertFalse($this->odbUser->estUser('AZERTY'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstUserTrueSiExistant()
	{
		$this->assertTrue($this->odbUser->estUser('tech1'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testEstUserFalseSiNullParam()
	{
		$this->assertFalse($this->odbUser->estUser());

		$this->assertFalse($this->odbUser->estUser(''));

		$this->assertFalse($this->odbUser->estUser('%'));
	}


	////////////////
	// getUser() //
	////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneUnUserSiNomValide()
	{
		$user = $this->odbUser->getUser('tech1');

		$this->assertNotEmpty($user);

		$this->assertInternalType('object', $user);

		$this->assertObjectHasAttribute('Use_Nom', $user);
		$this->assertObjectHasAttribute('Use_Num', $user);
		$this->assertObjectHasAttribute('Use_RespAchat', $user);
		$this->assertObjectHasAttribute('Use_Technicien', $user);
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourVideSiNomUserInvalide()
	{
		$this->assertEmpty($this->odbUser->getUser('azerty'));
		$this->assertEmpty($this->odbUser->getUser('0'));
		$this->assertEmpty($this->odbUser->getUser());
	}


	//////////////////////
	// checkHashUser() //
	//////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneFalseSiIdentifiantInvalide()
	{
		$this->assertFalse($this->odbUser->checkHashUser());
		$this->assertFalse($this->odbUser->checkHashUser('0', '0'));
		$this->assertFalse($this->odbUser->checkHashUser('azerty', 'azerty'));

		$this->assertFalse($this->odbUser->checkHashUser('tech1', 'azerty'));
		$this->assertFalse($this->odbUser->checkHashUser('azerty', '982a3889dd35194eb495b842e7eecfc9e4e1404621aadc51f68e850782bb791faffd144dd47016a337eb5f5ccc287b15f7af9262f56f3f44b649c038f2e3a40d'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneTrueSiIdentifiantValide()
	{
		$this->assertTrue($this->odbUser->checkHashUser('tech1', '982a3889dd35194eb495b842e7eecfc9e4e1404621aadc51f68e850782bb791faffd144dd47016a337eb5f5ccc287b15f7af9262f56f3f44b649c038f2e3a40d'));
	}


	//////////////////
	// saveToken() //
	//////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneFalseSiDataSavetokenInvalide()
	{
		$this->assertFalse($this->odbUser->saveToken());
		$this->assertFalse($this->odbUser->saveToken('', ''));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 */
	public function testRetourneTrueSiDataSavetokenValide()
	{
		$this->assertGreaterThan(0, $this->odbUser->saveToken('phpUnit-test', '1'));
	}


	/////////////////
	// getToken() //
	/////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 * @depends testRetourneTrueSiDataSavetokenValide
		 */
	public function testRetourVideSiNameTokenInvalide()
	{
		$this->assertEmpty($this->odbUser->getToken());
		$this->assertEmpty($this->odbUser->getToken('azerty'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 * @depends testRetourneTrueSiDataSavetokenValide
		 */
	public function testRetourneDataSiNameTokenValide()
	{
		$this->assertEquals('1', $this->odbUser->getToken('phpUnit-test'));
	}


	////////////////////
	// forgetToken() //
	////////////////////

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 * @depends testRetourneDataSiNameTokenValide
		 */
	public function testRetourneDeleteFalseSiNameTokenInvalide()
	{
		$this->assertFalse($this->odbUser->forgetToken());
		$this->assertFalse($this->odbUser->forgetToken('azerty'));
	}

		/**
		 * @depends testConnexionBddOk
		 * @depends testInstanciationDuModel
		 * @depends testRetourneDataSiNameTokenValide
		 */
	public function testRetourneDeleteTrueSiNameTokenValide()
	{
		$this->assertTrue($this->odbUser->forgetToken('phpUnit-test'));
		$this->assertEmpty($this->odbUser->getToken('phpUnit-test'));
	}

}
