CREATE OR REPLACE FUNCTION existeEtat
(
	pLibelleEta IN ETAT.Eta_Libelle%TYPE
)
RETURN boolean
IS
	iNb integer;
BEGIN
	SELECT COUNT(*)
	INTO iNb
	FROM ETAT
	WHERE Eta_Libelle = pLibelleEta;

	RETURN (iNb=1);
END;
/