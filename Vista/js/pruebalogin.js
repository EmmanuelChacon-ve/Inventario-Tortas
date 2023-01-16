const formulario = document.querySelector('form');
formulario.addEventListener('submit',validacion);

function validacion(e)
{
    e.preventDefault();
    const data = new FormData(formulario);

    //validando que no hayan espacios en blanco
    for(const value of data.values())
    {
        if(value === '') return console.log('no pueden espacios en blanco');
    }
    
    return conexion(data);
}

const conexion = async (data) =>{
    let request = await fetch('http://localhost/proyecto-final/Controlador/chef/login.php',{
        method: 'POST',
        body: data
    });
    let respuesta = await(request.json());
    
    if(respuesta.estado)
    {
        const usuario = new FormData();
        usuario.append('username',respuesta.usuario);
        
        mensajeExito(respuesta.mensaje);
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

function mensajeExito(mensaje){
    Swal.fire(
        'Excelente',
        mensaje,
        //revisar esta mrd
      ).then(() => location.replace("http://localhost/proyecto-final/Vista/chef/inicio.html"));
}