<?php
class Technicien
{
	public function __construct()
	{
		if (!($_SESSION['user']->estUser())) {
			# si pas login	
		}
	}
}
