	-- on change le delimiteur de fin d'instruction
DELIMITER //

	-- pour les ajout de velo, maj des data calculees
DROP TRIGGER IF EXISTS `trg_clc_velo_insert`;
//

CREATE TRIGGER `trg_clc_velo_insert`
AFTER INSERT ON `velo`
FOR EACH ROW
BEGIN
		-- si on fait une insertion :

		-- d'un velo sur une station, maj le nb de velo sur la station
	IF NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVelos = Sta_NbVelos + 1,
			Sta_NbAttacDispo = Sta_NbAttacDispo - 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

		-- d'un velo deteriore, maj le nb deteriore de la station
	IF NEW.Vel_Etat = 2 AND NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbDegrad = Sta_NbDegrad + 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

		-- d'un velo vole, maj le nb vole de la station
	IF NEW.Vel_Etat = 4 AND NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVols = Sta_NbVols + 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

END;
//

	-- pour les modif de velo, maj des data calculees
DROP TRIGGER IF EXISTS `trg_clc_velo_update`;
//

CREATE TRIGGER `trg_clc_velo_update`
AFTER UPDATE ON `velo`
FOR EACH ROW
BEGIN
		-- si on fait une maj du velo :

		-- avec une nouvelle station
	IF NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVelos = Sta_NbVelos + 1,
			Sta_NbAttacDispo = Sta_NbAttacDispo - 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

		-- avec une vielle station
	IF OLD.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVelos = Sta_NbVelos - 1,
			Sta_NbAttacDispo = Sta_NbAttacDispo + 1
		WHERE Sta_Code = OLD.Vel_Station;
	END IF;

		-- en deteriore
	IF NEW.Vel_Etat = 2 AND NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbDegrad = Sta_NbDegrad + 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

		-- en vole
	IF NEW.Vel_Etat = 4 AND NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVols = Sta_NbVols + 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

		-- on repasse un vole en autre chose
	IF OLD.Vel_Etat = 4 AND NEW.Vel_Etat != 4 AND OLD.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVols = Sta_NbVols - 1
		WHERE Sta_Code = OLD.Vel_Station;
	END IF;

END;
//

DELIMITER ;
