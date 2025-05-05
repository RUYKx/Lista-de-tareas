
// ejecuta una funcion si la condicion es verdadera
export function executeIf(condition, callback) {
    if (condition) {
        const res = callback();
        return res;
    }
    else{
        return false;
    }
}

// comprueba si una variable o una array de variables es definida y no es null
export function isDefined(variable) {

    if (Array.isArray(variable) && variable.length > 0) {
        return variable.every(varr => typeof varr !== 'undefined' && varr !== null);
    }
    else{
        return typeof variable !== 'undefined' && variable !== null;
    }
   
}

// Funcion que comprueba si una variable es vacia o no
export function isEmpty(variable) {
    if (variable === null || variable === undefined) {
        return true; // Null or undefined
    }

    if (typeof variable === "string" || Array.isArray(variable)) {
        return variable.length === 0; // Empty string or array
    }

    if (typeof variable === "object") {
        return Object.keys(variable).length === 0; // Empty object
    }

    return false; // For other types
}

// Funcion que comprueba si un array tiene todos sus elementos vacios o null
export function areIndexesEmpty(array) {
    if (!Array.isArray(array)) {
        throw new Error("The input must be an array.");
    }

    return array.every(item => item === null || item === undefined || item === "");
}

export function createModal(id, title, message, closeButtonText, confirmButtonText = "", confirmButtonURL = "") {
    // Guarda la ruta del directorio actual
    const currentDir = new URL('.', import.meta.url).pathname;

    // Importa el CSS del modal id
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = currentDir + '../css/modals/' + id + 'Modal.css';
    document.head.appendChild(link);

    // Crea el modal y le asigna el id, clase y lo oculta inicialmente
    const modal = document.createElement('div');
    modal.id = id;
    modal.className = 'modal';
    modal.style.display = 'flex'; // Initially visible

    // Crea el contenedor del contenido del modal
    const modalContent = document.createElement('div');
    modalContent.className = 'modal-content';

    // Add event listener to close modal when clicking outside the content
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.remove(); // Remove the modal if the click is outside the content
        }
    });

    // Crea el encabezado, cuerpo y pie del modal
    const modalContentHead = document.createElement('div');
    modalContentHead.className = 'modal-content-head';

    const modalContentBody = document.createElement('div');
    modalContentBody.className = 'modal-content-body';

    const modalContentFoot = document.createElement('div');
    modalContentFoot.className = 'modal-content-foot';

    // Crea el boton de cerrar
    const closeButton = document.createElement('span');
    closeButton.className = 'close-button';
    closeButton.id = 'closeButton';
    closeButton.innerHTML = closeButtonText; // Texto del boton de cerrar
    closeButton.onclick = function () {
        modal.remove(); // Elimina el modal al hacer click en el boton de cerrar
    };

    // Añade el boton de cerrar al pie del modal
    modalContentFoot.appendChild(closeButton);

    if (!areIndexesEmpty([confirmButtonText, confirmButtonURL])) {
        const confirmButton = document.createElement('span');
        confirmButton.className = 'confirm-button';
        confirmButton.id = 'confirmButton';
        confirmButton.innerHTML = "Confirmar"; // Texto del boton de confirmar
        confirmButton.onclick = function () {
            window.location.href = confirmButtonURL;
        };
        modalContentFoot.appendChild(confirmButton);
    }

    const Img = document.createElement('img');
    Img.src = currentDir + '../img/' + id + '.png'; // Ruta de la imagen de id
    Img.alt = id;
    Img.style.width = '20%'; // Ajusta el tamaño de la imagen según sea necesario
    Img.style.height = 'auto'; // Ajusta el tamaño de la imagen según sea necesario

    // Crea el titulo del modal
    const modalTitle = document.createElement('h2');
    modalTitle.textContent = title;

    // Crea el mensaje del modal
    const modalMessage = document.createElement('p');
    modalMessage.innerHTML = message;

    // Añade al encabezado del modal el boton de cerrar y el titulo
    modalContentHead.appendChild(Img);
    modalContentHead.appendChild(modalTitle);

    // Añade el mensaje al cuerpo del modal
    modalContentBody.appendChild(modalMessage);

    // Añade los elementos al contenedor del modal
    modalContent.appendChild(modalContentHead);
    modalContent.appendChild(modalContentBody);
    modalContent.appendChild(modalContentFoot);

    // Añade el contenedor del contenido al modal
    modal.appendChild(modalContent);

    // Añade el modal al body del documento
    document.body.appendChild(modal);

    return true; // Retorna true si el modal se ha creado correctamente
}

// Funcion que crea un modal y lo muestra en pantalla
export function showModal(id, title, message, closeButtonText, confirmButtonText = "", confirmButtonURL = "") {

    const confirmModalConditions = 
        isDefined([id,title, message, closeButtonText, confirmButtonText, confirmButtonURL]) && 
        !areIndexesEmpty([id,title, message, closeButtonText, confirmButtonText, confirmButtonURL]);

    const closeButtonConditions =
        isDefined([id,title, message, closeButtonText]) && 
        !areIndexesEmpty([id,title, message, closeButtonText]);
    
    executeIf(
        !executeIf(
            confirmModalConditions,
            () => 
            {
                createModal(id, title, message, closeButtonText, confirmButtonText, confirmButtonURL);
                return true; // Modal created successfully
            }
        ) && closeButtonConditions,
        () => 
        {
            createModal(id, title, message, closeButtonText);
            return true; // Modal created successfully
        }

    );
}