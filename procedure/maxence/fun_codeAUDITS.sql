CREATE OR REPLACE FUNCTION codeAudits
Return number 
IS 
 
	iNb Number; 
BEGIN 
	SELECT MAX(AUD_CODE) INTO iNb 
	FROM AUDITS; 
 
	Return (iNb); 
 
END;