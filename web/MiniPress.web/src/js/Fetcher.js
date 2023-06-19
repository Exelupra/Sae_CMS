export function load(element){
    return fetch('http://localhost/Sae_CMS/web/MiniPress.core/index.php/api' + element).then(response => {
        if (response.ok) return response.json();
        return Promise.reject(new Error(response.statusText))
    }).catch(error => console.log(error));
}