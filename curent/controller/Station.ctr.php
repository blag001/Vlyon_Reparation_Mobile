<?php
class Station
{
	// private $obdStation = new User();

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
		$this->afficherLesStations();
	}

	protected function afficherLesStations()
	{
		view('htmlHeader');
		view('contentAccueil');
		view('htmlFooter');
	}
}
