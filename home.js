
function openChat() {
    help_button.classList.add("hidden");
    chat_container.classList.remove("hidden");
}

function minimizeChat() {
    help_button.classList.remove("hidden");
    chat_container.classList.add("hidden");
}

//devo anche svuotare la chat
function closeChat(){
    const chat=document.querySelector("#chat");
    chat.innerHTML="";
    body.messages.length=0;
    body.messages.push(
        { role: "system", content: "Sei un assistente gentile e disponibile. Aiuti i clienti di un sito di e-commerce che vende abbigliamento sportivo, scarpe e accessori per diverse discipline" }
    );
    const text_container=document.querySelector("#text-container");
    text_container.classList.add("hidden");
    startChatButton.classList.remove("hidden");
    startChatButton.parentElement.classList.remove("hidden");
    help_button.classList.remove("hidden");
    chat_container.classList.add("hidden");
}

function onScroll(){
    const nav_bottom=document.querySelector("#nav-bottom");
    if (window.scrollY>32){
        nav_bottom.classList.add("scrolled");
    } else{
        nav_bottom.classList.remove("scrolled");
    }
}

function changeSRC(event){
    const image = event.currentTarget;
    new_src=image.dataset.alt;
    image.dataset.alt=image.src;
    image.src=new_src;
}

function showTag(event){
    const container = event.currentTarget;
    const text= container.dataset.tag;
    if(text){
        const tag= document.createElement('div');
        tag.textContent= text;
        tag.classList.add("tag");
        container.appendChild(tag);
    }
}

function hideTag(event){
    const container = event.currentTarget;
    const tag= container.querySelector(".tag");
    if(tag){
        tag.remove();
    }
}

// main

window.addEventListener("scroll", onScroll); //evento che rileva lo scorrimento della finestra

const help_button = document.querySelector("#help-button");
const chat_container= document.querySelector("#chat-container");
const minimize_button = document.querySelector("#minimize");
const close_button = document.querySelector("#close");

help_button.addEventListener("click", openChat);
minimize_button.addEventListener("click", minimizeChat);
close_button.addEventListener("click", closeChat);

const images_outlet = document.querySelectorAll("#outlet img");
for(let i=0; i<images_outlet.length; i++){
    images_outlet[i].addEventListener("mouseenter", changeSRC);
    images_outlet[i].addEventListener("mouseleave", changeSRC);
}

const container_collection = document.querySelectorAll("#collection .photo-container");
for(let i=0; i<container_collection.length; i++){
    container_collection[i].addEventListener("mouseenter", showTag);
    container_collection[i].addEventListener("mouseleave", hideTag);
}



//REST API

// 1

function onJson(json){
    const response= json;
    const email_input=document.querySelector("#email-validation");
    const error_message= document.querySelector("#first .error_message")
    if (
        response.deliverability === "DELIVERABLE" && //email raggiungibile
        response.is_valid_format.value && //struttura corretta
        response.is_mx_found.value && //il dominio dell’email ha un record MX, cioè accetta email
        response.is_smtp_valid.value //il server SMTP del dominio ha risposto correttamente
      ) {
        email_input.classList.remove("error");
        error_message.classList.add("hidden");
        email_input.value="";
        alert("Email valida! Grazie per esserti iscritto.");
      } else {
        email_input.classList.add("error");
        error_message.classList.remove("hidden");
        email_input.value="";
      }
}

function onResponse(response){
    return response.json();
}

function emailValidation(event){
    event.preventDefault();
    const email_input=document.querySelector("#email-validation");
    const email_value=email_input.value;
    fetch("email_validation.php?email=" + encodeURIComponent(email_input.value)).then(onResponse).then(onJson);
}

const form= document.querySelector("#first form");
form.addEventListener("submit", emailValidation);


// 2


function updateMessages(role_input, content_input){
    body.messages.push({
        role: role_input, content: content_input
    })
    const new_message= document.createElement("div");
    new_message.textContent=content_input;
    const chat= document.querySelector("#chat");
    if (role_input ==='user'){
        new_message.classList.add("message", "user-message");
        chat.appendChild(new_message);
    } else{
        new_message.classList.add("message", "assistant-message");
        chat.appendChild(new_message);
    }
    console.log(body.messages);
}

function onAIjson(json){
    console.log(json);
    const reply = json.choices[0].message.content;
    updateMessages("assistant", reply);
}

function onAIresponse(response){
    return response.json();
}

function newMessage(event){
    if(event.key === 'Enter') {
        event.preventDefault();
        const text_input= event.currentTarget;
        const text_value= text_input.value;
        text_input.value = "";
        updateMessages("user", text_value);
        fetch("chat_proxy.php", {
            method: "POST",
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify(body)
        }).then(onAIresponse).then(onAIjson);
    }
}

function startChat(event){
    const button= event.currentTarget;
    button.classList.add("hidden");
    button.parentElement.classList.add("hidden");

    const text_container = document.querySelector("#text-container");
    text_container.classList.remove("hidden");

    updateMessages("assistant", "Ciao, sono l'assistente virtuale di The North Face. Come posso aiutarti?");

    const textarea = document.querySelector("#text-container textarea");
    textarea.addEventListener("keydown", newMessage);
}


const body = {
    messages: [
      { role: "system", content: "Sei un assistente gentile e disponibile. Aiuti i clienti di un sito di e-commerce che vende abbigliamento sportivo, scarpe e accessori per diverse discipline" }
    ],
    max_tokens: 800,
    temperature: 0.6,
    top_p: 0.9,
    frequency_penalty: 0,
    presence_penalty: 0
};

const startChatButton=document.querySelector("#middle-chat .button-container button");
startChatButton.addEventListener("click", startChat);

