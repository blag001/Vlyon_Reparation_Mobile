<?php
/**
 * fichier de test du model des Velos
 */

	/**
	 * class de test de la gestion BDD des Velos
	 */
class OdbVeloTest extends PHPUnit_Framework_TestCase
{

	public function testConnexionBddOk()
	{
		$out = $_SESSION['bdd']->query('SELECT 1 as nb', null, Bdd::SINGLE_RES);

		$this->assertEquals('1', $out->nb);
	}

		/**
		 * @depends testConnexionBddOk
		 */
	public function testFail()
	{
		$odbVelo = new OdbVelo();

		$this->assertTrue(is_object($odbVelo));

		$this->assertInstanceOf('OdbVelo', $odbVelo);
	}
	// assertObjectHasAttribute
}
