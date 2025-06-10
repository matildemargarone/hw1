function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckFavourites(json) {
    const container = document.getElementById('favourites-container');
    container.innerHTML = '';

    if (!json || json.length === 0) {
        container.innerHTML = '<p>Non hai ancora aggiunto articoli ai preferiti.<a href="home.php">Inizia ad esplorare!</a></p>';
        return;
    }

    for (let i = 0; i < json.length; i++) {
        const item = json[i];

        const div = document.createElement('div');
        div.classList.add('favourite-item');

        const img = document.createElement('img');
        img.src = item.article_src;

        const title = document.createElement('h2');
        title.textContent = item.article_name;

        const button = document.createElement('button');
        button.textContent = 'Rimuovi';
        button.classList.add('button');
        button.dataset.id = item.articleid;
        button.addEventListener('click', removeFavourite);

        div.appendChild(img);
        div.appendChild(title);
        div.appendChild(button);
        container.appendChild(div);
    }
}

function handleRemoveFavouriteResponse(json) {
    if (!json) {
        console.log('Errore: risposta non valida dal server');
        return;
    }
    
    if (json.success) {
        getFavourites(); // ricarica la lista
    } else {
        console.error('Errore nella rimozione del preferito:', json.error);
        alert('Errore: ' + json.error);
    }
}

function removeFavourite(event) {
    const articleId = event.currentTarget.dataset.id;

    fetch("remove_favourites.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: "id=" + encodeURIComponent(articleId)
    })
    .then(fetchResponse).then(handleRemoveFavouriteResponse);
}

function getFavourites() {
    fetch('get_favourites.php').then(fetchResponse).then(jsonCheckFavourites);
}

document.addEventListener('DOMContentLoaded', getFavourites);
