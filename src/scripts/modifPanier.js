function clicAjouter(event){
    //Ajout dans le panier
    ajouterPanier(event.target,"add");    
}
function clicRetirer(event){
    //Suppression du panier
    ajouterPanier(event.target,"remove");
}


function ajouterPanier(elmt, action)
{
    idCd = elmt.parentElement.parentElement.getAttribute("id");

    if (action == "add")
    {
        compteur = elmt.nextElementSibling;
        nbArticles = parseInt(compteur.textContent);
        compteur.textContent = nbArticles + 1;
        majPanier(action, idCd);
    }
    else if (action == "remove")
    {
        compteur = elmt.previousElementSibling;
        nbArticles = parseInt(compteur.textContent);
        if (nbArticles != 0)
        {
            compteur.textContent = nbArticles - 1;
            majPanier(action, idCd);
        }
    }
}

//Met a jour la panier et renvoie si ça a reusi ou non
function majPanier(action, cdId)
{
    var xhr = new XMLHttpRequest();    
    xhr.open("POST", "scripts/majArticlesPanier.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('id='+cdId+'&action='+action);
}

document.querySelectorAll(".btnAjouterPanier").forEach(elmt => elmt.addEventListener("click", clicAjouter));
document.querySelectorAll(".btnRetirerPanier").forEach(elmt => elmt.addEventListener("click", clicRetirer));
