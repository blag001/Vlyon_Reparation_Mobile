CREATE OR REPLACE FUNCTION existeTechnicien
(pNomTec IN TECHNICIEN.Tec_nom%type
pPrenomTec IN TECHNICIEN.Tec_Prenom%type)
RETURN boolean
IS
	iNbTec  number(2):=0 ;
BEGIN 
	SELECT count(*)
	INTO iNbTec
	FROM Technicien
	WHERE Tec_Nom = pNomTec
	AND Tec_Prenom = pPrenomTec	;
	RETURN (iNbTec >= 1);
 END ;
/