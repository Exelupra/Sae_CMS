export function load(element){
    return fetch('/Sae_CMS/web/MiniPress.core/src' + element).then(response => {
        if (response.ok) return response.json();
        return Promise.reject(new Error(response.statusText))
    }).catch(error => console.log(error));
}