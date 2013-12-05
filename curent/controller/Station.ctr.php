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

		if (empty($_GET['action']))
			$_GET['action'] = null;

		switch ($_GET['action']) {
			case 'value':
				# code...
				break;

			default:
				$this->afficherLesStations();
				break;
		}
	}

	protected function afficherLesStations()
	{
		$lesStations = $this->odbStation->getLesStations();
		view('htmlHeader');
		view('contentAllStation');
		view('htmlFooter');
	}
}
