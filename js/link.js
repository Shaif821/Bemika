
    var linkje = document.getElementById('linkyt');
    linkje.addEventListener("click", linkklik);


    function linkklik() {

        //Dit moet binnen gebeuren
        var test = linkje.textContent;

        if (test == "Add YouTube link") {
            document.getElementById("YTLinkje").style.opacity = 1;
            linkje.innerHTML = "Geen link";
        } else if (test == "Geen link") {
            document.getElementById("YTLinkje").style.opacity = 0;
            linkje.innerHTML = "Add YouTube link";
        }
    }

    var del = document.getElementsByClassName("deldel");
    del.addEventListener("click", delklik);

    function delklik(){
        var delknop = document.getElementsByClassName("delbut");
        var deltext = delknop.textContent;

        if(deltext == "Delete article?"){
            document.getElementsByClassName("deldel").style.display = "block";
            deltext.innerHTML = "Dont delete";
        }else if (deltext == "Dont delete"){
            document.getElementsByClassName("deldel").style.display = "none";
            deltext.innerHTML = "Delete article?"
        }

    }


