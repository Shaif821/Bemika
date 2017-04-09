
function showList(str, typeSearch) {
    console.log(typeSearch);
    //Als de input veld leeg is, da leegt de functie de content van de livesearch placeholder en exits de functie
    if (str == "") {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border="0px";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //Als de input veld niet leeg is, dan voert showResult() het volgende uit:
        //- Maakt een XMLHttpRequest object
        xmlhttp.onreadystatechange = function() {
            //Maakt een functie dat uitgevoerd wordt wanneer de server response klaar is
            if (xmlhttp.readyState == 4 && this.status == 200) {
                if(typeSearch == "list"){
                    //var myArr = JSON.parse(xmlhttp.responseText);
                    //printArray(myArr);
                    document.getElementById("livesearch").innerHTML = xmlhttp.responseText;

                }
                if(typeSearch == "answer"){
                    document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
                }
                //Verzend de request naar een bestand op de server
            }
        };
        //De parameter q is toegevoegd aan de URL met de content van de input field
        xmlhttp.open("GET","getuser.php?q="+str+"&type="+typeSearch,true);
        xmlhttp.send();
    }
}