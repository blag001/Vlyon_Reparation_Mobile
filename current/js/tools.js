// fonction JS perso

	/**
	 * gere un objet de connexion http
	 *
	 * @return {object} objet de conexion suivant le navigateur
	 */
function _getReqHttp()
{
	var reqHttp = null;

	if(window.XMLHttpRequest){
		// Firefox (Mozilla) et autres
		reqHttp = new XMLHttpRequest();
	}
	else{
		if(window.ActiveXObject){
			// Internet Explorer
			try{
				reqHttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e){
				reqHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		else{
			// XMLHttpRequest non supporté par le navigateur
			reqHttp = false;
		}
	}

	return reqHttp;
}

	/**
	 * envois le(s) argument(s) sur l'url cible et met le retour dans l'idTarget
	 * @param  {string} methode   POST ou GET
	 * @param  {string} urlTarget l'url visee par la requete AJAX
	 * @param  {string} arg       le(s) arguement(s) a passer
	 * @param  {string} idTarget  l'id de reception du retour
	 * @return {void}           pas de retour
	 */
function ajax(methode, urlTarget, arg, idTarget )
{
	// récupération d'un objet XMLHttpRequest
	var reqHttp1 = _getReqHttp() ;

	if ( reqHttp1 == null){
		alert("Impossible d'utiliser Ajax sur ce navigateur");
	}
	else
	{
		reqHttp1.onreadystatechange = function()
		{
			if (reqHttp1.readyState == 4 && reqHttp1.status == 200)
			{
				leChampsTarget = document.getElementById(idTarget);
				leChampsTarget.innerHTML = reqHttp1.responseText;
			}
		}

		if ( methode == "POST")
		{
			// ouverture de la connexion avec le serveur
			reqHttp1.open("POST", encodeURI(urlTarget), true) ;
			reqHttp1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			// envoi de la requête
			reqHttp1.send(arg);
		}
		else if (methode == "GET")
		{
			// ouverture de la connexion avec le serveur - méthode GET - asynchrone
			reqHttp1.open("GET", encodeURI(urlTarget) + "?" + encodeURI(arg), true);
			// envoi de la requête
			reqHttp1.send(null);
		}
	}
}
