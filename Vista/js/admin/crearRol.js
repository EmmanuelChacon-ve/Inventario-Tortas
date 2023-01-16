//obteniendo formulario
const form = document.querySelector('form');
const selectPrincipal = document.querySelector('#select');

//obteniendo roles
const request = new Request('../../../Controlador/admin/privilegio.php',
{
    method: 'POST',
});

fetch(request)
.then((respuesta) => 
{
    if(!respuesta) throw new Error('ah ocurrido un error intentalo mas tarde')
    return respuesta.json();
})
.then(respuesta => 
    {
    //para evitar overflow
    const fragment = document.createDocumentFragment();
    //para colocar valor y ordenar por id
    for(const value of respuesta){
        const option = document.createElement('option');
        option.setAttribute('value',value.id)
        option.textContent = value.descripcion;
        fragment.append(option);
    }
    selectPrincipal.append(fragment);
    })
.catch(err => console.log(err));

//validando datos ingresados

form.addEventListener('submit',validar);

function validar(e)
{
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


//funcion para enviarPeticion
async function conexion(data)
{
    let request = await fetch('../../../Controlador/login/insert.php',
    {
        method: 'POST',
        body: data,
    });

    request = await request.json();

    request.estado? mensajeExito(request.mensaje) : mensajeError(request.mensaje);
}
//

function mensajeError(mensaje){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje,
      }).then(() => location.reload());
}

function mensajeExito(mensaje){
    Swal.fire(
        'Registrado con exito!',
        mensaje,
      ).then(() => location.reload());
}