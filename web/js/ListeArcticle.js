import {afficherArticles, afficherCategories} from "./ui/Liste_ui";
import {load} from "./Fetcher";

function listePlusRecent(){
    afficherArticles(load("/api/articles"));
}

function categories(){
    afficherCategories(load("/api/categories"));
}