const form = document.querySelector('form');
form.addEventListener('submit',registrar);

function registrar(e){
    e.preventDefault();
    //para manejar los inputs por sus nombres
    const data = new FormData(form);
    //agregando submit por validacion
    data.append('submit','submit');
    //devolviendo un iterador asi podemos ver los valores registrados
    for(const value of data.values())
    {
        if(value === '') return mensajeError('no pueden haber espacios en blanco');
    }

    function soloLetras(...valores){
        //expresion regular ^ indica que se busque al principio de la cadena
        //* busca de 0 a mas coincidencias la i es una bandera que evita la capitalizacion de las letras
        const regex = /^[a-z]*$/i;
        //el metodo test evalua si hay coincidencia y devuelve un booleano
        for(const value of valores)
        {
            if(!regex.test(value)) return mensajeError('Ingrese solo letras en los campos de usuario');
        }
        return validarPassword(pass,confirm);
    }

    function validarPassword(pass){
        // explicacion del regex https://www.revivemyvote.com/preguntas-javascript/regex-para-la-contrasena-debe-contener-al-menos-ocho-caracteres-al-menos-un-numero-y-letras-mayusculas-y-minusculas-y-caracteres-especiales/
        const regex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/;
        if(!regex.test(pass)) return mensajeError('la contraseña debe tener ocho caracteres, incluida una letra mayúscula, un carácter especial y caracteres alfanuméricos');
        if(pass !== confirm) return mensajeError('la confirmacion no concuerda con la clave');
        else return conexion(data);
    }

    function validarEmail(email){
        const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if(!regex.test(email)) return mensajeError('ingrese un correo valido');
        else return soloLetras(nombre);
    }

    //para validar los datos obtenidos 

    let email = data.get('email');
    let nombre  = data.get('name');
    let pass    = data.get('password');
    let confirm = data.get('cfpassword');

    validarEmail(email);
}

function mensajeError(mensaje){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje,
      });
}

function mensajeExito(mensaje){
    Swal.fire(
        'Registrado con exito!',
        mensaje,
      ).then(() => location.replace('./'));
}

const conexion = (data) =>{
    let request;
    if(window.XMLHttpRequest){
        request = new XMLHttpRequest();
    }else{
        request = new ActiveXObject('Microsoft.XMLHTTP');
    } 

    request.addEventListener('load', () =>
    {
        let respuesta = request.response;
        if(respuesta.estado){
            mensajeExito(respuesta.mensaje);
        }else{
            mensajeError(respuesta.mensaje);
        }
    });

    request.open(
        'POST',//metodo a usar
        'http://localhost/proyecto-final/Controlador/chef/add/insert.php', //destino
        true, //si queremos que sea asincrono
        request.responseType = 'json' //tipo de elemento enviado
    );

    request.send(data);
}


// async function conexion(data){
//     const respuesta = await fetch('./controlador/insert.php',{
//         method: 'POST',
//         body: data
//     })
    
    

// }


