const chatInput = document.querySelector(".chat-input textarea ");
const sendChatBtn = document.querySelector(".chat-input span");
const chatbox = document.querySelector(".chatbox");
//Mostrar y Ocultar el chat
const chatbotToggler = document.querySelector(".chatbot-toggler");
const chatbotCloseBtn = document.querySelector(".close-btn")



let userMessage;
const inputInitHeight = chatInput.scrollHeight;

const createChatLi = (message, className) => {
    // Crear un elemento de chat <li> con el mensaje pasado y el nombre de clase
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", className);
    let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">person</span><p></p>`
    chatLi.innerHTML = chatContent;
    chatLi.querySelector("p").textContent = message;
    return chatLi;
}

const generateResponse = () => {
    const SERVER_URL = "http://localhost:3300/get-response"; // URL de tu servidor Node.js

    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ message: userMessage })
    }

    // Enviar solicitud al servidor Node.js y obtener una respuesta
    fetch(SERVER_URL, requestOptions)
        .then(res => res.json())
        .then(data => {
            // Crear un nuevo elemento de chat entrante con la respuesta del servidor
            const incomingChatLi = createChatLi(data.response, "incoming");
            chatbox.appendChild(incomingChatLi);
            chatbox.scrollTo(0, chatbox.scrollHeight);
        })
        .catch((error) => {
            console.error("Error:", error);
            // Manejar el error y mostrar un mensaje en el chat
            const errorResponse = "Hubo un error al obtener la respuesta.";
            const errorChatLi = createChatLi(errorResponse, "incoming");
            chatbox.appendChild(errorChatLi);
            chatbox.scrollTo(0, chatbox.scrollHeight);
        });
}

const handleChat = () => {
    userMessage = chatInput.value.trim();
    if (!userMessage) return;
    // Dejar el mensaje en blanco después de terminar de escribir
    chatInput.value = "";
    // Resetear el área de texto a la altura por defecto una vez es enviado el mensaje
    chatInput.style.height = `${inputInitHeight}px`;

    // Agregar el mensaje del usuario al chatbox (saliente)
    const outgoingChatLi = createChatLi(userMessage, "outgoing");
    chatbox.appendChild(outgoingChatLi);
    chatbox.scrollTo(0, chatbox.scrollHeight);

    // Llamar a generateResponse para obtener la respuesta del servidor y agregarla al chatbox (entrante)
    generateResponse();
}

chatInput.addEventListener("input", () => {
    // Ajustar la altura del área de texto de entrada según el contenido
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`; 
})

chatInput.addEventListener("keydown", (e) => {
    // Uso del enter para enviar y el shift+enter para continuar al siguiente parrafo
    if(e.key === "Enter" && !e.shiftKey && window.innerWidth> 800){
        e.preventDefault();
        handleChat();
    }
})

//Click al enviar el mensaje
sendChatBtn.addEventListener("click", handleChat);
//Cerrar el chat
chatbotCloseBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
//Usando el mostrar y ocultar
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));