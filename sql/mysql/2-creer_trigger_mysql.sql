	-- on change le delimiteur de fin d'instruction
DELIMITER //

	-- pour les ajout de velo, maj des data calcule de la station
DROP TRIGGER IF EXISTS `trg_clc_velo_insert`;
//

CREATE TRIGGER `trg_clc_velo_insert`
AFTER INSERT ON `velo`
FOR EACH ROW
BEGIN
		-- si on fait une insertion avec une station
	IF NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVelos = Sta_NbVelos + 1,
			Sta_NbAttacDispo = Sta_NbAttacDispo - 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;
END;
//

	-- pour les modif de velo, maj des data calcule de la station
DROP TRIGGER IF EXISTS `trg_clc_velo_update`;
//

CREATE TRIGGER `trg_clc_velo_update`
AFTER UPDATE ON `velo`
FOR EACH ROW
BEGIN
		-- si on fait une maj avec une nouvelle station
	IF NEW.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVelos = Sta_NbVelos + 1,
			Sta_NbAttacDispo = Sta_NbAttacDispo - 1
		WHERE Sta_Code = NEW.Vel_Station;
	END IF;

		-- si on fait une maj avec une vielle station
	IF OLD.Vel_Station > 0 THEN
		UPDATE station SET
			Sta_NbVelos = Sta_NbVelos - 1,
			Sta_NbAttacDispo = Sta_NbAttacDispo + 1
		WHERE Sta_Code = OLD.Vel_Station;
	END IF;
END;
//

DELIMITER ;
