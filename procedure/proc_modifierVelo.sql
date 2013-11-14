CREATE OR REPLACE ModifierVelo
(pStationCode IN Station.Sta_Code%TYPE,
pProduitCodeVelo IN Produit.pdt_Code%TYPE,
pCodeEtat IN ETAT.Eta_Code%TYPE)
IS 
	pVelNum Velo.Vel_Num%TYPE;
	err_NotExiste Exception;
BEGIN 
	IF (existeVelo(pVelNum)) = TRUE THEN
		UPDATE VELO
		SET Vel_Station=pStation,
			Vel_Etat=pCodeEtat,
			Vel_type=pTypeVelo,
			Vel_Accessoire=pAccessoire
		WHERE Vel_Num=pVelNum
	ELSE 
		RAISE err_NotExiste
	END IF;
	
EXCEPTION 
	WHEN err_NotExiste THEN
	INSERT INTO AUDITS(AUD_NUMERO,AUD_LIBELLE)
	VALUES (sCode, "Erreur lors de la recherche du vélo, il n'existe pas")
END;
	