const selectTorta       = document.querySelector('.tortas');
const selectIngrediente = document.querySelector('.ingredientes');
const texto             = document.querySelector('.explicacion');

//prueba
let funcionAgregar;
let desInsumos;
let insumos = [];

fetch('../../Controlador/chef/receta.php')
.then((response) =>
{
    if(!response.ok)
    {
        throw new Error('ah ocurrido un error con tortas intentalo mas tarde');
    }
    return response.json();
})
.then((response) =>
{
    let datos = response[0];
    // descripcion insumos 
    desInsumos = datos.des_insumos;
    //agregando tortas
    let tortas = crearSelect(datos.tortas);
    selectTorta.append(tortas);
    //sacando ingredientes
    //elemento seleccionado
    insumos = datos.insumos;
    let seleccionado = selectTorta.options[selectTorta.selectedIndex].value;
    let aux = ingredientes(seleccionado,datos.receta,datos.insumos);
    selectIngrediente.append(aux);
    textoReceta();
    return {'receta' : datos.receta, 'insumos': datos.insumos};
})

.then((response) =>
{
    selectTorta.addEventListener('change',() =>
    {
        let seleccionado = selectTorta.options[selectTorta.selectedIndex].value;
        let aux = ingredientes(seleccionado,response.receta,response.insumos);
        selectIngrediente.textContent = '';
        selectIngrediente.append(aux);
        textoReceta();
    })
    selectIngrediente.addEventListener('change', () => textoReceta());
})

.catch((err) => console.log(err))


function crearSelect(datos)
{
    //si tiene la propiedad unidad se maneja distinto
    //
    //para evitar overflow
    let fragment = document.createDocumentFragment();
    for(const value of datos){
        const option = document.createElement('option');
        option.setAttribute('value',value.id);
        option.textContent = "ID: " + value.id + "  " + value.nombre;
        if(value.hasOwnProperty('unidad'))
        {
            if(value.cantidad) option.dataset.cantidad = value.cantidad;
            option.dataset.medida   = obteniendoMedida(value).nombre;
            option.dataset.idmedida = obteniendoMedida(value).id;
        }
        fragment.append(option);
    }
    return fragment;
}

function ingredientes(seleccionado,datos,ingredientes)
{
    let aux = [];
    datos = datos.filter((datos) => datos.id == seleccionado);
    for(let i = 0;i<datos.length;i++){
        ingredientes.forEach((item) => 
        {
            if(datos[i].nombre == item.id)
            {
                item.cantidad = datos[i].cantidad;
                aux.push(item);
            }
        })
    }
    return crearSelect(aux);
}

function obteniendoMedida(value)
{
    let nombreMedida = desInsumos.filter(item => item.id == value.unidad);
    return {'nombre': nombreMedida[0].nombre, 'id': nombreMedida[0].id};
}

function textoReceta()
{
    texto.textContent = '';
    let aux = selectIngrediente.options[selectIngrediente.selectedIndex];
    if(aux === undefined) return texto.textContent = 'no hay ingredientes registrados. Agrega para hacer la mejor Receta!!';
    let medida   = aux.dataset.medida;
    let cantidad = aux.dataset.cantidad;
    texto.textContent = `${aux.textContent} medida utilizada ${medida} cantidad utilizada ${cantidad} ${medida}`;
}

//agregando listeners a los submit

const botones  = document.querySelectorAll('.btnCrud');
const formCrud = document.querySelector('form');
const formulario = formCrud.cloneNode(true);

botones.forEach(item => item.addEventListener('click',handlerBotones));

function handlerBotones(e)
{
    if(e.target.matches('#agregar'))
    {
        if(formCrud.children.length != 0)
        {
            formCrud.replaceChildren('');
            formCrud.removeEventListener('submit',conexionEditar);
        }
        const template = document.querySelector('#agregar-template');
        const clone = template.content.cloneNode(true);
        //obtener insumos actuales
        aux = getInsumosFaltantes();
        //porque tiene todos los ingredientes
        if(!aux.length)
        {
            mensajeError('tiene todos los ingredientes existentes');
            return;
        }
        //
        //agregando al template
        aux = crearSelect(aux);
        
        const input = clone.querySelector('#cantidad');
        const select = clone.querySelector('select');
        
        select.append(aux);
        //para que diga la medida a agregar
        const unidadMedida = () => {
            input.placeholder = '';
            input.placeholder += "cantidad a utilizar en " + select.options[select.selectedIndex].dataset.medida;
        };
        unidadMedida();
        //detecte el cambio
        select.addEventListener('change',unidadMedida)
        formCrud.append(clone);
        //listener
        const cancelar = formCrud.querySelector('.cancel');
        cancelar.addEventListener('click',() => location.reload())
        formCrud.addEventListener('submit',conexionAgregar);
        //
        selectTorta.addEventListener('change',selectAgregar)
        function selectAgregar(e)
        {
            const boton = formCrud.querySelector('.submitAgregar');
            //
            let aux = getInsumosFaltantes();
            if(!aux.length)
            {
                // boton.style.visibility = 'hidden';
                select.textContent = '';
                input.placeholder = 'Tiene todos los elementos existentes';
                boton.disabled = true;
                input.disabled = true;
                return;
            }
            input.disabled = false;
            boton.disabled = false;
            // boton.style.visibility = 'visible';
            aux = crearSelect(aux);
            //vaciando los select
            select.textContent = '';
            input.placeholder = '';
            //agregando nuevos
            select.append(aux);
            unidadMedida(input,select);
        }
        funcionAgregar = selectAgregar;
    }

    if(e.target.matches('#editar'))
    {
        function pruebaVacio(input,boton)
        {
            
            if(selectIngrediente.value === '')
            {
                input.placeholder = 'no hay elementos disponibles';
                input.disabled = true;
                boton.disabled = true;
            }else {
                input.disabled = false
                boton.disabled = false;
                unidadMedida(input);
            }
        }

        function unidadMedida(input){
            input.placeholder = '';
            input.placeholder += "cantidad a utilizar en " + selectIngrediente.options[selectIngrediente.selectedIndex].dataset.medida;
        };

        if(formCrud !== 0)
        {
            selectTorta.removeEventListener('change',funcionAgregar);
            formCrud.replaceChildren('');
            formCrud.removeEventListener('submit',conexionAgregar)
        }
        const template = document.getElementById('editar-template');
        const clone    = template.content.cloneNode(true);
        const input    = clone.querySelector('#cantidad');
        const boton    = clone.querySelector('.submitEditar');
        //vacio los ingredientes
        pruebaVacio(input,boton);
        //cantidad en el input


        selectTorta.addEventListener('change',handlerEdit);
        function handlerEdit()
        {
            pruebaVacio(input,boton);
        }

        selectIngrediente.addEventListener('change',() => {pruebaVacio(input)})

        formCrud.append(clone);

        formCrud.addEventListener('submit',conexionEditar);

    }
    if(e.target.matches('#eliminar'))
    {
        const ingrediente = selectIngrediente.value;
        if(ingrediente === '') return mensajeError('no hay elementos que borrar');
        conexionBorrar();
    }
}

// function getInsumosActuales()
// {
//             //ingredientes actuales
//     let actuales = [];
//         for(const value of selectIngrediente.options)
//             {
//                 actuales.push(value.value);
//             }
//     //filtrnado ingredientes faltantes
//     let aux = [...insumos];
//         for(const value of actuales)
//             {
//                 let numero = aux.findIndex(item => item.id == value);
//                 aux.splice(numero,1);
//             }
//     return aux;
// }

// tratando de dividir en dos 

function getInsumosActuales()
{
    //ingredientes actuales
    let actuales = [];
        for(const value of selectIngrediente.options)
            {
                actuales.push(value.value);
            }
    return actuales;
}

function getInsumosFaltantes()
{
    //filtrnado ingredientes faltantes
    actuales = getInsumosActuales();
    let aux = [...insumos];
        for(const value of actuales)
            {
                let numero = aux.findIndex(item => item.id == value);
                aux.splice(numero,1);
            }
    return aux;
}

//funcion para agregar
async function conexionAgregar(e)
{
    e.preventDefault();
    const data = new FormData(e.target);
    let panActual = selectTorta.value;
    let idMedida  = e.target.querySelector('.insumo');
    idMedida = idMedida.options[idMedida.selectedIndex].dataset.idmedida;
    let prueba = data.values();
    for(const value of prueba)
    {
        if(value === '') return mensajeError('no pueden haber espacios en blanco');
    }
    data.append('submit','submit');
    data.append('torta',panActual);
    data.append('idMedida',idMedida);
   
    let request  = await fetch('../../Controlador/chef/add/agregarIngrediente.php',
    {
        method: 'POST',
        body: data
    });
    if(!request.ok) mensajeError('ah ocurrido un error intentalo mas tarde');
    request = await request.json();
    if(request.estado)
    {
        mensajeExito(request.mensaje);
    }else
    {
        mensajeError(request.mensaje);
    }
}

async function conexionEditar(e)
{
    e.preventDefault();
    const data = new FormData(e.target);
    for(const value of data.values())
    {
        if(value === '') return e.target.querySelector('#cantidad').focus();
    }
    const torta = selectTorta.options[selectTorta.selectedIndex].value;
    const insumo = selectIngrediente.options[selectIngrediente.selectedIndex].value;
    
    data.append('edit','edit');
    data.append('torta',torta);
    data.append('insumo',insumo);

    let request = await fetch('../../Controlador/chef/edit/editarIngrediente.php',
    {
        method: 'POST',
        body: data
    });
    if(!request.ok) return mensajeError('ah ocurrido un error intentelo mas tarde');
    request = await request.json();
    if(request.estado)
    {
        mensajeExito(request.mensaje);
    }else
    {
        mensajeError(request.mensaje);
    }
}

function conexionBorrar(e)
{
    Swal.fire({
        title: 'Seguro que quiere borrar este ingrediente?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si, estoy seguro',
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          //confirmado
          const data = new FormData();
          const torta = selectTorta.options[selectTorta.selectedIndex].value;
          const insumo = selectIngrediente.options[selectIngrediente.selectedIndex].value;
          
          data.append('torta',torta)
          data.append('insumo',insumo);
          data.append('borrar','borrar');
         conexionBorrarFinal(data);

        } else if (result.isDenied) {
          Swal.fire('Los cambios no se guardaron', '', 'info')
        }
      })
}

async function conexionBorrarFinal(data)
{
 let request = await fetch('../../Controlador/chef/delete/deleteIngrediente.php',
 {
    method: 'POST',
    body: data
 });
 if(!request.ok) mensajeError('ah ocurrido un error intentelo mas tarde');
 request = await request.json();
 if(request.estado)
 {
     mensajeExito(request.mensaje);
 }else
 {
     mensajeError(request.mensaje);
 }
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
        'Proceso realizado con exito!',
        mensaje,
      ).then(() => location.reload());
}