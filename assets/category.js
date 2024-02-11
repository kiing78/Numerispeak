function typeButtonClicked(element){
    var form = document.getElementById('formRadio');
    var selection_categories = document.getElementById("selection_categories");
    var bouton_categories = document.getElementById("bloc_bouton_categories");
    var form_categories = document.getElementById("form_categories");

    var titre_categories = document.getElementById("titre_categories");
    var bloc_selection_categories = document.getElementById("bloc_selection_categories");
    var name_category = document.getElementById("name_category");

    switch(element.id){
        case "addLink":
            form.action = '{{path("app_category_new")}';
            selection_categories.setAttribute("style", "display : none");
            bouton_categories.setAttribute("style", "display : none");
            form_categories.setAttribute("style", "display : flex");
            titre_categories.innerText = "Ajouter une catégorie";
            name_category.setAttribute("style", "display : flex");
        break;
        case "updateLink":
            form.action = 'category/edit'; // Change l'attribut action du formulaire
            selection_categories.setAttribute("style", "display : none");
            bouton_categories.setAttribute("style", "display : none");
            form_categories.setAttribute("style", "display : flex");
            titre_categories.innerText = "Editer une catégorie";
            bloc_selection_categories.setAttribute("style", "display : flex");
            name_category.setAttribute("style", "display : flex");
        break;
        case "deleteLink":
            form.action = 'category/delete'; // Change l'attribut action du formulaire
            selection_categories.setAttribute("style", "display : none");
            bouton_categories.setAttribute("style", "display : none");
            form_categories.setAttribute("style", "display : flex");
            titre_categories.innerText = "Supprimer une catégorie";
            bloc_selection_categories.setAttribute("style", "display : flex");
        break;
        default:
            form.action = '';
            selection_categories.setAttribute("style", "display : flex");
            bouton_categories.setAttribute("style", "display : flex");
            form_categories.setAttribute("style", "display : none");
            titre_categories.innerText = "";
            bloc_selection_categories.setAttribute("style", "display : none");
            name_category.setAttribute("style", "display : none");
        break;
    }
}
