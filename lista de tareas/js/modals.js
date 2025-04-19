
// ejecuta una funcion si la condicion es verdadera
export function executeIf(condition, callback) {
    if (condition) {
        callback();
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

// Funcion que crea el modal pidiendo el titulo, mensaje y id del modal
export function createErrorModal(id, title, message,) {

    // Crea el modal y le asigna el id, clase y lo oculta inicialmente
    const modal = document.createElement('div');
    modal.id = id;
    modal.className = 'modal';
    modal.style.display = 'flex'; // Initially hidden

    // Crea el contenedor del contenido del modal
    const modalContent = document.createElement('div');
    modalContent.className = 'modal-content';

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
    closeButton.innerHTML = 'Intentar de nuevo';
    closeButton.onclick = function () {
        document.getElementById(id).style.display = 'none';
    };

    const errorImg = document.createElement('img');
    errorImg.src = '../img/error.png'; // Ruta de la imagen de error
    errorImg.alt = 'Error';
    errorImg.className = 'error-img'; // Clase para la imagen de error
    errorImg.style.width = '20%'; // Ajusta el tamaño de la imagen según sea necesario
    errorImg.style.height = 'auto'; // Ajusta el tamaño de la imagen según sea necesario


    // Crea el titulo del modal
    const modalTitle = document.createElement('h2');
    modalTitle.textContent = title;

    // Crea el mensaje del modal
    const modalMessage = document.createElement('p');
    modalMessage.textContent = message;


    // Añade al encabezado del modal el boton de cerrar y el titulo
    modalContentHead.appendChild(errorImg);
    modalContentHead.appendChild(modalTitle);

    // Añade el mensaje al cuerpo del modal
    modalContentBody.appendChild(modalMessage);

    // Añade el boton de cerrar al pie del modal
    modalContentFoot.appendChild(closeButton);


    // Añade los elementos al contenedor del modal
    modalContent.appendChild(modalContentHead);
    modalContent.appendChild(modalContentBody);
    modalContent.appendChild(modalContentFoot);

    // Añade el contenedor del contenido al modal
    modal.appendChild(modalContent);

    // Añade el modal al body del documento
    document.body.appendChild(modal);

}
