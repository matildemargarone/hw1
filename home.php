<?php 
    require_once 'auth.php';
    if (!checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css?v=2">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="home.js" defer></script>
        <script src="add_favourites.js" defer></script>
    </head>
    <body>
        <div id="promo-bar">
            <div id="promo-container">
                <div id="bar-top">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7071 4.29289C16.0976 4.68342 16.0976 5.31658 15.7071 5.70711L9.41421 12L15.7071 18.2929C16.0976 18.6834 16.0976 19.3166 15.7071 19.7071C15.3166 20.0976 14.6834 20.0976 14.2929 19.7071L7.29289 12.7071C7.10536 12.5196 7 12.2652 7 12C7 11.7348 7.10536 11.4804 7.29289 11.2929L14.2929 4.29289C14.6834 3.90237 15.3166 3.90237 15.7071 4.29289Z"></path>
                        </svg>
                    </div>
                    <div id="promo">
                        CONSEGNA STANDARD GRATUITA PER ORDINI SUPERIORI A 110€
                    </div>
                    <div class="icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.29289 4.29289C8.68342 3.90237 9.31658 3.90237 9.70711 4.29289L16.7071 11.2929C17.0976 11.6834 17.0976 12.3166 16.7071 12.7071L9.70711 19.7071C9.31658 20.0976 8.68342 20.0976 8.29289 19.7071C7.90237 19.3166 7.90237 18.6834 8.29289 18.2929L14.5858 12L8.29289 5.70711C7.90237 5.31658 7.90237 4.68342 8.29289 4.29289Z"></path>
                        </svg>
                    </div>
                </div>
                <div id="bar-bottom">
                    <div id="white"></div>
                    <div id="gray"></div>
                </div>
            </div>
        </div>
        <header>
            <nav>
                <div id="nav-top">
                    <a class="container-flag">
                        <img src="https://www.thenorthface.it/img/flags/IT.svg">
                        <span>IT</span>
                    </a>
                    <a>Stato dell'ordine</a>
                    <a>XPLR Pass</a>
                    <a>Trova un punto vendita</a>
                    <a>Assistenza</a>
                    <a>Gift Card</a>
                    <a href="favourites.php">Preferiti</a>
                    <a href="logout.php">Logout</a>
                </div>
                <div id="nav-bottom">
                    <a class="container-logo">
                        <img src="https://www.thenorthface.it/img/logos/thenorthface/default.svg">
                    </a>
                    <div id="container-nav">
                        <div id="menu">
                            <div class="menu-item">
                                <a>Uomo</a>
                            </div>
                            <div class="menu-item">
                                <a>Donna</a>
                            </div>
                            <div class="menu-item">
                                <a>Bambino</a>
                            </div>
                            <div class="menu-item">
                                <a>Scarpe</a>
                            </div>
                            <div class="menu-item">
                                <a>Borse & Attrezzatura</a>
                            </div>
                            <div class="menu-item">
                                <a>Outlet</a>
                            </div>
                        </div>
                        <div id="container-sc">
                            <div id="search">
                                <input type="text" placeholder="Cerca">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                                    <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
                                </svg>
                            </div>
                            <div id="cart">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483.1 483.1">
	                                <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24zM363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div id="icon-container">
                        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                            <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483.1 483.1">
                            <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24zM363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
                        </svg>
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.844 6.050c-0.256-0.256-0.381-0.581-0.381-0.975s0.125-0.719 0.381-0.975 0.581-0.381 0.975-0.381h28.512c0.394 0 0.719 0.125 0.975 0.381s0.381 0.581 0.381 0.975-0.125 0.719-0.381 0.975-0.581 0.381-0.975 0.381h-28.512c-0.394 0-0.719-0.125-0.975-0.381zM31.306 14.963c0.256 0.256 0.381 0.581 0.381 0.975s-0.125 0.719-0.381 0.975-0.581 0.381-0.975 0.381h-28.512c-0.394 0-0.719-0.125-0.975-0.381s-0.381-0.581-0.381-0.975 0.125-0.719 0.381-0.975 0.581-0.381 0.975-0.381h28.512c0.394 0 0.719 0.125 0.975 0.381zM31.306 25.819c0.256 0.256 0.381 0.581 0.381 0.975s-0.125 0.719-0.381 0.975-0.581 0.381-0.975 0.381h-28.512c-0.394 0-0.719-0.125-0.975-0.381s-0.381-0.581-0.381-0.975 0.125-0.719 0.381-0.975 0.581-0.381 0.975-0.381h28.512c0.394 0 0.719 0.131 0.975 0.381z"></path>
                        </svg>
                    </div>
                </div>
            </nav>
            <div class="text">
                <h1 class="title">Sentiti come a casa.</h1>
                <div class="button-container">
                    <div class="button">
                        <a>Acquista attrezzatura da campeggio</a>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div id="first-banner">
                <div class="text">
                    <h1 class="title">La mug per le tue pause outdoor.</h1>
                    <p class="par">Ricevi una mug in regalo, acquistando la nostra attrezzatura da camping.<br>
                        Solo per i membri XPLR Pass</p>
                    <div class="button-container">
                        <div class="button">
                            <a>Acquista ora</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="second-banner">
                <div class="text">
                    <h1 class="title">Nuovi arrivi <br>
                    per nuovi inizi.</h1>
                    <div class="button-container">
                        <div class="button">
                            <a>Acquista donna</a>
                        </div>
                        <div class="button">
                            <a>Acquista uomo</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="two-photo-container">
                <div class="photo-container">
                    <img src="https://assets.thenorthface.eu/image/upload/c_limit,w_1920/q_auto:best,f_auto:image/v1742571981/tnf-ss25-w52-update-hp-small_banner_1-desk">
                    <div class="text">
                        <p class="par">Pensate per nuovi sentieri.</p>
                        <div class="button-container">
                            <div class="button">
                                <a>Acquista uomo</a>
                            </div>
                            <div class="button">
                                <a>Acquista donna</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="photo-container">
                    <img src="https://assets.thenorthface.eu/image/upload/c_limit,w_1920/q_auto:best,f_auto:image/v1742910152/tnf-ss25-w52-update-hp-small_banner_2-desk-new">
                    <div class="text">
                        <p class="par">Progettati per affrontare il meteo avverso.</p>
                        <div class="button-container">
                            <div class="button">
                                <a>Acquista uomo</a>
                            </div>
                            <div class="button">
                                <a>Acquista donna</a>
                            </div>
                            <div class="button">
                                <a>Acquista bambino</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="four-photo-section" id="outlet">
                <h1 class="title">The North Face Outlet</h1>
                <p class="par">Gli articoli che ami a prezzo ridotto, tutto l'anno.</p>
                <div class="four-photo-container">
                    <div class="photo-container">
                        <img src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1739521896/NF0A88YZQLI-HERO/Womens-Polar-Nuptse-Jacket.jpg" data-alt="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1739521874/NF0A88YZQLI-ALT1/Womens-Polar-Nuptse-Jacket.jpg">
                        <div class="button-container">
                            <div class="button">
                                <a>Acquista donna</a>
                            </div>
                        </div>
                    </div>
                    <div class="photo-container">
                        <img src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1742487733/NF0A82VU5OG-HERO/Mens-Freedom-Insulated-Jacket.jpg" data-alt="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1742487705/NF0A82VU5OG-ALT1/Mens-Freedom-Insulated-Jacket.jpg">
                        <div class="button-container">
                            <div class="button">
                                <a>Acquista uomo</a>
                            </div>
                        </div>
                    </div>
                    <div class="photo-container">
                        <img src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1739526008/NF0A82TS4FO-HERO/Kids-1996-Retro-Nuptse-Jacket.jpg" data-alt="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1739525979/NF0A82TS4FO-ALT1/Kids-1996-Retro-Nuptse-Jacket.jpg">
                        <div class="button-container">
                            <div class="button">
                                <a>Acquista bambino</a>
                            </div>
                        </div>
                    </div>
                    <div class="photo-container">
                        <img src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1720799314/NF0A3VWQVEN-HERO/Cotton-Tote-Bag.png" data-alt="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1720799318/NF0A3VWQVEN-ALT2/Cotton-Tote-Bag.png">
                        <div class="button-container">
                            <div class="button">
                                <a>Acquista borse e bagagli</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="four-photo-section" id="collection">
                <h1 class="title">Attrezzatura sostenibile</h1>
                <p class="par">Un nuovo design per un mondo migliore.</p>
                <div class="button">
                    <a>Scopri di più</a>
                </div>
                <div class="four-photo-container">
                    <div class="photo-container" data-id="1" data-tag="Bagaglio a mano" data-name="Duffel Base Camp Voyager 42 L">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1727711106/NF0A52RQA72-HERO/Base-Camp-Voyager-Duffel-42L.jpg" >
                    </div>
                    <div class="photo-container" data-id="2" data-tag="Tasca per laptop" data-name= "Zaino Router">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1720647148/NF0A52SF4HF-HERO/Router-Backpack.png" >
                    </div>
                    <div class="photo-container" data-id="3" data-tag="Impermeabile" data-name="Trolley All Weather con 4 ruote 30”">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1720652366/NF0A52RU53R-HERO/All-Weather-4Wheeler-Luggage-30.png">
                    </div>
                    <div class="photo-container" data-id="4" data-name="Zaino Trail Lite 50L da donna">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1743693386/NF0A81CH4WJ-HERO/Womens-Trail-Lite-Backpack-50L.jpg">
                    </div>
                    <div class="photo-container" data-id="5" data-tag="Asciugatura rapida" data-name="Borsa tote Borealis">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1734620772/NF0A52SV4HF-HERO/Borealis-Tote-Bag.jpg">
                    </div>
                    <div class="photo-container" data-id="6" data-name="Beauty case Base Camp Voyager">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1720732174/NF0A81BL53R-HERO/Base-Camp-Voyager-Wash-Bag.png" >
                    </div>
                    <div class="photo-container" data-id="7" data-tag="Tasca per laptop" data-name="Zaino Base Camp Voyager Large">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1738002329/NF0A8BK4B7I-HERO/Base-Camp-Daypack.jpg">
                    </div>
                    <div class="photo-container" data-id="8" data-name="Borsone per attrezzatura Base Camp Medium">
                        <img class="articoli" src="https://assets.thenorthface.eu/images/t_img/f_auto,h_462,w_462,e_sharpen:60/dpr_2.0/v1720806742/NF0A52SAS9W-HERO/Base-Camp-Duffel-Medium.png">
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div id="first">
                <h1 class="title">Unisciti a XPLR Pass</h1>
                <p class="par">Iscriviti alla newsletter e ricevi in anteprima le ultime novità e offerte esclusive.</p>
                <form>
                    <input type="text" placeholder="Inserisci il tuo indirizzo email" id="email-validation">
                    <input type="submit" value="Iscriviti ora" class="button">
                </form>
                <p class="error_message hidden">Email non valida. Riprova!</p>
            </div>
            <div id="second">
                <div class="second-item">
                    <h1 class="title">ACQUISTA</h1>
                    <ul>
                        <li>
                            <a>Uomo</a>
                        </li>
                        <li>
                            <a>Donna</a>
                        </li>
                        <li>
                            <a>Bambini</a>
                        </li>
                        <li>
                            <a>Borse & Attrezzature</a>
                        </li>
                        <li>
                            <a>Scarpe</a>
                        </li>
                    </ul>
                </div>
                <div class="second-item">
                    <h1 class="title">ORDINI</h1>
                    <ul>
                        <li>
                            <a>Segui il tuo ordine</a>
                        </li>
                        <li>
                            <a>Spedizioni</a>
                        </li>
                        <li>
                            <a>Resi</a>
                        </li>
                        <li>
                            <a>Sconto Studenti</a>
                        </li>
                    </ul>
                </div>
                <div class="second-item">
                    <h1 class="title">HELP</h1>
                    <ul>
                        <li>
                            <a>Contattaci</a>
                        </li>
                        <li>
                            <a>Domande Frequenti</a>
                        </li>
                        <li>
                            <a>Garanzie</a>
                        </li>
                        <li>
                            <a>Condizioni d'uso</a>
                        </li>
                        <li>
                            <a>Informativa sulla Privacy</a>
                        </li>
                        <li>
                            <a>Guida Alle taglie</a>
                        </li>
                        <li>
                            <a>Preferenza dei Cookie</a>
                        </li>
                        <li>
                            <a>Dichiarazione di Conformità</a>
                        </li>
                    </ul>
                </div>
                <div class="second-item">
                    <h1 class="title">CHI SIAMO</h1>
                    <ul>
                        <li>
                            <a>La Nostra Storia</a>
                        </li>
                        <li>
                            <a>Sostenibilità</a>
                        </li>
                        <li>
                            <a>Atleti</a>
                        </li>
                        <li>
                            <a>Tecnologie</a>
                        </li>
                        <li>
                            <a>The North Face Pro Program</a>
                        </li>
                        <li>
                            <a>Lavora Con Noi</a>
                        </li>
                        <li>
                            <a>Notizie</a>
                        </li>
                    </ul>
                </div>
                <div class="second-item">
                    <h1 class="title">GLI EVENTI</h1>
                    <ul>
                        <li>
                            <a>Basecamp</a>
                        </li>
                        <li>
                            <a>Transgrancanaria</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="last">
                <a class="container-logo">
                    <img src="https://www.thenorthface.it/img/logos/thenorthface/default.svg">
                </a>
                <div id="text-footer">
                    <a>Privacy Policy</a>
                    <a>Termini di utilizzo</a>
                </div>
                <a class="container-flag">
                    <img src="https://www.thenorthface.it/img/flags/IT.svg">
                    <span>IT | Cambia Paese</span>
                </a>
            </div>
        </footer>
        <div id="help-button">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60">
                <path d="M26,9.586C11.664,9.586,0,20.09,0,33c0,4.499,1.418,8.856,4.106,12.627c-0.51,5.578-1.86,9.712-3.813,11.666 c-0.304,0.304-0.38,0.768-0.188,1.153C0.276,58.789,0.625,59,1,59c0.046,0,0.093-0.003,0.14-0.01 c0.349-0.049,8.432-1.213,14.317-4.585c3.33,1.333,6.874,2.009,10.544,2.009c14.336,0,26-10.503,26-23.414S40.337,9.586,26,9.586z"></path> <path d="M55.894,37.042C58.582,33.27,60,28.912,60,24.414C60,11.503,48.337,1,34,1c-8.246,0-15.968,3.592-20.824,9.42 C17.021,8.614,21.38,7.586,26,7.586c15.439,0,28,11.4,28,25.414c0,5.506-1.945,10.604-5.236,14.77 c4.946,1.887,9.853,2.6,10.096,2.634c0.047,0.006,0.094,0.01,0.14,0.01c0.375,0,0.724-0.211,0.895-0.554 c0.192-0.385,0.116-0.849-0.188-1.153C57.753,46.753,56.403,42.619,55.894,37.042z"></path>
            </svg>
            <span>Chat</span>
        </div>
        <div class="hidden" id="chat-container">
            <div id="top-chat">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60">
                    <path d="M26,9.586C11.664,9.586,0,20.09,0,33c0,4.499,1.418,8.856,4.106,12.627c-0.51,5.578-1.86,9.712-3.813,11.666 c-0.304,0.304-0.38,0.768-0.188,1.153C0.276,58.789,0.625,59,1,59c0.046,0,0.093-0.003,0.14-0.01 c0.349-0.049,8.432-1.213,14.317-4.585c3.33,1.333,6.874,2.009,10.544,2.009c14.336,0,26-10.503,26-23.414S40.337,9.586,26,9.586z"></path> <path d="M55.894,37.042C58.582,33.27,60,28.912,60,24.414C60,11.503,48.337,1,34,1c-8.246,0-15.968,3.592-20.824,9.42 C17.021,8.614,21.38,7.586,26,7.586c15.439,0,28,11.4,28,25.414c0,5.506-1.945,10.604-5.236,14.77 c4.946,1.887,9.853,2.6,10.096,2.634c0.047,0.006,0.094,0.01,0.14,0.01c0.375,0,0.724-0.211,0.895-0.554 c0.192-0.385,0.116-0.849-0.188-1.153C57.753,46.753,56.403,42.619,55.894,37.042z"></path>
                </svg>
                <span>Chatta con noi</span>
                <svg class="icon" id="minimize" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <path d="M50,48.5c0,0.8-0.7,1.5-1.5,1.5h-45C2.7,50,2,49.3,2,48.5v-3C2,44.7,2.7,44,3.5,44h45c0.8,0,1.5,0.7,1.5,1.5V48.5z"/>
                </svg>
                <svg class="icon" id="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <path d="M31,25.4L44,12.3c0.6-0.6,0.6-1.5,0-2.1L42,8.1c-0.6-0.6-1.5-0.6-2.1,0L26.8,21.2c-0.4,0.4-1,0.4-1.4,0L12.3,8c-0.6-0.6-1.5-0.6-2.1,0l-2.1,2.1c-0.6,0.6-0.6,1.5,0,2.1l13.1,13.1c0.4,0.4,0.4,1,0,1.4L8,39.9c-0.6,0.6-0.6,1.5,0,2.1l2.1,2.1c0.6,0.6,1.5,0.6,2.1,0L25.3,31c0.4-0.4,1-0.4,1.4,0l13.1,13.1c0.6,0.6,1.5,0.6,2.1,0l2.1-2.1c0.6-0.6,0.6-1.5,0-2.1L31,26.8C30.6,26.4,30.6,25.8,31,25.4z"/>
                </svg>
            </div>
            <div id="middle-chat">
                <div id="chat"></div>
                <div id="text-container" class="hidden">
                    <textarea rows=1 placeholder="Digita il tuo messaggio..."></textarea>
                </div>
                <div class="button-container">
                    <button>Chatta ora</button>
                </div>
            </div>
        </div>
    </body>
</html>
