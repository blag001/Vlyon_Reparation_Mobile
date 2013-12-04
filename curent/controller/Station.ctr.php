<?php
class Station
{
	private $odbStation;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		// si il est connecte
		$this->odbStation = new OdbStation();

		$this->afficherLesStations();
	}

	protected function afficherLesStations()
	{
		view('htmlHeader');
		view('contentAccueil');
		view('htmlFooter');
	}
}
