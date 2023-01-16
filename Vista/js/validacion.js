//validando formulario
const form = document.querySelector('form');
const emailF = form.querySelector('.email');
const textoF = form.querySelector('.texto');
const passF  = form.querySelector('.password');
const boton = form.querySelector('.boton-validador');
console.log(boton);

for(let i = 0;i<form.children.length;i++)
{
    if(form.children[i].querySelector('input'))
    {
        form.children[i].querySelector('input').addEventListener("keyup",validacion);
    }
}

function validacion(e)
{
    const colorTexto = (bool) => (bool)? e.target.style.color = "#FF0000" : e.target.style.color = "#000";
    if(e.target.matches('.texto'))
    {
        const regex =  /^[A-Z]+$/i;
        colorTexto(!regex.test(e.target.value));
    }
    if(e.target.matches('.email'))
    {
        const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        colorTexto(!regex.test(e.target.value));
    }
    if(e.target.matches('.password'))
    {
        const regex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/;
        colorTexto(!regex.test(e.target.value));
    }
}

boton.addEventListener('click',(e) =>
{
    e.preventDefault();
    const data = new FormData(form);
    const textoRegex = /^[A-Z]+$/i;
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    const passwordRegex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/;
    const conexion = form.querySelector('.original');

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
        else return conexion.click();
    }

    function validarEmail(email){
        const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if(!regex.test(email)) return mensajeError('ingrese un correo valido');
        else return soloLetras(nombre);
    }

    let email = data.get('email');
    let nombre = data.get('usuario');
    let pass = data.get('contraseña');

    validarEmail(email);
})

function mensajeError(mensaje,){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje,
      })
}

function mensajeExito(mensaje){
    Swal.fire(
        'Registrado con exito!',
        mensaje,
      ).then(() => location.replace('./'));
}