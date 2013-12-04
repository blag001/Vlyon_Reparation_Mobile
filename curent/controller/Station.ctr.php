<?php
class Station
{
	protected $obdStation = new OdbStation;

	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login
		}
	}

	protected function afficherLesStations()
	{
		view('htmlHeader');
	}
}
