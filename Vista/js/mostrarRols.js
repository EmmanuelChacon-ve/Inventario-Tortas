//variables globales
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
        option.textContent = `ID: ${value.id} ` +value.descripcion;
        fragment.append(option);
    }
    selectPrincipal.append(fragment);
    })
.catch(err => console.log(err));

