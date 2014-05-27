	-- on change le delimiteur de fin d'instruction
DELIMITER //

	-- pour les ajout de velo, maj des data calculees
DROP TRIGGER IF EXISTS `trg_velo_insert`;
//

CREATE TRIGGER `trg_velo_insert`
BEFORE INSERT ON `velo`
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
DROP TRIGGER IF EXISTS `trg_velo_update`;
//

CREATE TRIGGER `trg_velo_update`
BEFORE UPDATE ON `velo`
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

	-- pour les ajout d'intervention
DROP TRIGGER IF EXISTS `trg_boninterv_insert`;
//

CREATE TRIGGER `trg_boninterv_insert`
BEFORE INSERT ON `boninterv`
FOR EACH ROW
BEGIN
		-- si on fait une insertion :

		-- avec une demande liee
	IF NEW.BI_Demande > 0 THEN
		UPDATE demandeinter SET
			DemI_Traite = 1
		WHERE DemI_Num = NEW.BI_Demande;
	END IF;

		-- avec un velo non casse
	IF NEW.BI_Reparable > 0 THEN
		UPDATE velo SET
			Vel_Etat = 1
		WHERE Vel_Num = NEW.BI_Velo;
		-- avec un velo casse
	ELSE
		UPDATE velo SET
			Vel_Casse = 1
		WHERE Vel_Num = NEW.BI_Velo;
	END IF;

END;
//

	-- pour les ajout de demande d'intervention
DROP TRIGGER IF EXISTS `trg_demandeinter_insert`;
//

CREATE TRIGGER `trg_demandeinter_insert`
BEFORE INSERT ON `demandeinter`
FOR EACH ROW
BEGIN
		-- si on fait une insertion :

		-- on passe le velo en deteriore
	IF NEW.DemI_Velo > 0 THEN
		UPDATE velo SET
			Vel_Etat = 2
		WHERE Vel_Num = NEW.DemI_Velo;
	END IF;

END;
//

DELIMITER ;
