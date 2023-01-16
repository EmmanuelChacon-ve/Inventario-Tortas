const formulario = document.querySelector('form');
formulario.addEventListener('submit',validacion);

function validacion(e)
{
    e.preventDefault();
    const data = new FormData(formulario);

    //validando que no hayan espacios en blanco
    for(const value of data.values())
    {
        if(value === '') return mensajeError('no pueden espacios en blanco');
    }
    
    return conexion(data);
}

const conexion = async (data) =>{
    let request = await fetch('Controlador/login/login.php',{
        method: 'POST',
        body: data
    });
    let respuesta = await(request.json());
    const url = respuesta.newUrl;
    if(respuesta.estado)
    {
        const usuario = new FormData();
        usuario.append('username',respuesta.usuario);
        
        mensajeExito(respuesta.mensaje,url);
    }else
    {
        return mensajeError(respuesta.mensaje);
    }
}

function mensajeError(mensaje){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje,
      }).then(() => location.reload());
}

function mensajeExito(mensaje,url){
    Swal.fire(
        'Excelente',
        mensaje,
        //locacion a la que debe enviar se puede manejar promesa
      ).then(() => location.replace(url));
}