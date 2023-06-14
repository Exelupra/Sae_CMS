export function load(element){
    return fetch('' + element).then(response => {
        if (response.ok) return response.json();
        return Promise.reject(new Error(response.statusText))
    }).catch(error => console.log(error));
}