const valores = window.location.search;
const url     = new URLSearchParams(valores);
const usuario = url.get('usuario');
const form    = document.querySelector('form');

usuario ?? location.replace('./');

form.addEventListener('submit',validacion);

function validacion(e)
{
    e.preventDefault();

    const data = new FormData(form);
    data.append('usuario',usuario);
    for(const value of data.values()){
        if(value === '') return mensajeError('no pueden haber espacios en blanco');
    }
    
    function validarPassword(pass,confirm){
    // explicacion del regex https://www.revivemyvote.com/preguntas-javascript/regex-para-la-contrasena-debe-contener-al-menos-ocho-caracteres-al-menos-un-numero-y-letras-mayusculas-y-minusculas-y-caracteres-especiales/
    const regex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/;
    if(!regex.test(pass)) return mensajeError('la contraseña debe tener ocho caracteres, incluida una letra mayúscula, un carácter especial y caracteres alfanuméricos');
    if(pass !== confirm) return mensajeError('la confirmacion no concuerda con la clave');
    else return conexion(data);
    }

    const password = data.get('password');
    const confirm  = data.get('cfpassword');
    validarPassword(password,confirm);
}

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
      ).then(() => location.replace('./'));
}

const conexion = async (data) =>
{
    let request = await fetch('http://localhost/proyecto-final/controlador/login/editpassword.php',{
        method: 'POST',
        body: data
    });
    try{
        if(request.status !== 200) throw new Error('ah ocurrido un error intentalo mas tarde');
        let resultado = await request.json();
        if(resultado.reload) return mensajeError(resultado.mensaje);
        resultado.estado? mensajeExito(resultado.mensaje) : mensajeError(resultado.mensaje);
    }catch(err){
        mensajeError(err);
    }

}
