//validando formulario
const form = document.querySelector('form');
const boton = form.querySelector('.boton-validador');
const original = form.querySelector('.original');
let inputs = [];

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
        if(!inputs.some((item) => item == 'texto'))
        {
            inputs.push('texto');
        }
    }
    if(e.target.matches('.textoEspacio'))
    {
        const regex =  /^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/;
        colorTexto(!regex.test(e.target.value));
        if(!inputs.some((item) => item == 'textoEspacio'))
        {
            inputs.push('textoEspacio');
        }
    }
    if(e.target.matches('.email'))
    {
        const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        colorTexto(!regex.test(e.target.value));
        if(!inputs.some((item) => item == 'email'))
        {
            inputs.push('email');
        }
    }
    if(e.target.matches('.password'))
    {
        const regex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/;
        colorTexto(!regex.test(e.target.value));
        if(!inputs.some((item) => item == 'password'))
        {
            inputs.push('password');
        }
    }
    if(e.target.matches(".numeros"))
    {
        const regex = /^[0-9]+$/;
        colorTexto(!regex.test(e.target.value));
        if(!inputs.some((item) => item == 'numeros'))
        {
            inputs.push('numeros');
        }
    }
}

boton.addEventListener('click',(e) =>
{
    
    e.preventDefault();
    if(inputs.length === 0) return original.click();
    let gatillo = false;
    const data = new FormData(form);
    for(const value of data.values())
    {
        if(value === '') return mensajeError('no pueden haber espacios en blanco');
    }
    inputs.forEach((item) =>
    {
        if(item === 'texto')
        {
            const regex =  /^[A-Z]+$/i;
            const input = form.querySelector('.texto');

            if(input){
                if(!regex.test(input.value))
                {
                    mensajeError('ingrese solo letras');
                    input.value = '';
                    return gatillo = false;
                }else gatillo = true;
            }
        }
        if(item === 'numeros')
        {
            const regex = /^[0-9]+$/;
            const input = form.querySelector('.numeros');

            if(input)
            {
                if(!regex.test(input.value))
                {
                    mensajeError('ingrese solo numeros');
                    input.value = '';
                    return gatillo = false;
                }else gatillo = true;
            }
        }
        if(item === 'textoEspacio')
        {
            const regex =  /^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/;
            const input = form.querySelector('.textoEspacio');

            if(input)
            {
                if(!regex.test(input.value))
                {
                    mensajeError('ingrese solo letras');
                    input.value = '';
                    return gatillo = false;
                }else gatillo = true;
            }
        }
    } )
    if(gatillo)
    {
        original.click();
    }
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