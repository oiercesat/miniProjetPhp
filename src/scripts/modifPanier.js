articlespanier = []


function clicAjouter(e){
    //Incrementation
    nbArticles = parseInt(e.target.nextElementSibling.textContent);
    e.target.nextElementSibling.textContent = nbArticles + 1;

    //Ajout dans le panier
}
function clicRetirer(e){
    //Decrementation
    nbArticles = parseInt(e.target.previousElementSibling.textContent);
    if (nbArticles != 0)
    {
        //On retire 1
        e.target.previousElementSibling.textContent = nbArticles - 1;
    }

    //Suppression du panier
}
function clicValider(){
    
}




document.querySelectorAll(".btnAjouterPanier").forEach(elmt => elmt.addEventListener("click", clicAjouter));
document.querySelectorAll(".btnRetirerPanier").forEach(elmt => elmt.addEventListener("click", clicRetirer));
document.getElementByID("bValidationPanier").addEventListener("click", clicValider);

