const heart = "heart-svgrepo-com.png"
const heart_b = "heart-svgrepo-com-black.png"

function addFavourite(event){
    event.currentTarget.src = heart_b;
    const container = event.currentTarget.parentNode;
    const img = container.querySelector(".articoli");
    
    const formData = new FormData();
    formData.append('id', container.dataset.id);
    formData.append('name', container.dataset.name);
    formData.append('src', img.src);
    
    // for (let [key, value] of formData.entries()) {
    //     console.log(key, value);
    // }
    
    fetch("add_favourites.php",{method: 'post', body: formData}).then(dispatchResponse, dispatchError);
}

function dispatchResponse(response) {
    console.log(response);
    return response.json().then(databaseResponse); 
}

function dispatchError(error) { 
    console.log("Errore");
}

function databaseResponse(json) {
    if (!json.ok) {
        dispatchError();
        return null;
    }
    console.log("Articolo aggiunto ai preferiti correttamente!");
}

function showHeart(event){
    const container = event.currentTarget;
    
    // Evita di aggiungere più cuori
    if (container.querySelector(".like")) {
        return;
    }
    
    const img = document.createElement('img');
    img.src = heart;
    img.classList.add("like");
    img.addEventListener('click', addFavourite);
    container.appendChild(img);
}

function hideHeart(event){
    const container = event.currentTarget;
    const img = container.querySelector(".like");
    if(img){
        img.removeEventListener('click', addFavourite);
        img.remove();
    }
}

const collection = document.querySelectorAll("#collection .photo-container");
console.log("Trovati", collection.length, "container");

for(let i = 0; i < collection.length; i++){
    collection[i].addEventListener("mouseenter", showHeart);
    collection[i].addEventListener("mouseleave", hideHeart);
}