  const listado = document.querySelector("#tarjeta");
    

    // CARGAR PRODUCTOS 
    async function loadProductos() {
        let res = await fetch("api.php");
        let productos = await res.json();

        listado.innerHTML = "";

        productos.forEach(p => {
            listado.innerHTML += `
            <tr>
                <td>${p.id}</td>
                <td>${p.titulo}</td>
                <td>${p.categoria}</td>
                <td>${p.descripcion}</td>
                <td><img src="${p.imagen}" width="100"></td>
                <td class="button-administracion">
                    <button onclick="editar(${p.id})" class="button-administracion-editar">Editar</button>
                    <button onclick="eliminar(${p.id})" class="button-administracion-eliminar">Eliminar</button>
                </td>   
                
            </tr>`;
        });
    }

    loadProductos();


