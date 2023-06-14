import {afficherArticles, afficherCategorie} from "./ui/Liste_ui";
import {load} from "./Fetcher";

function listePlusRecent(){
    afficherArticles(load( /*Lien a rajouter*/ ));
}

function categories(){
    afficherCategorie(load( /*Lien a rajouter*/ ));
}