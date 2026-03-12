const modal = document.querySelector("#modal");
const form = document.querySelector("#formProducto");

    // NUEVO PRODUCTO
    document.querySelector("#btnNuevo").onclick = () => {
        form.reset();
        form.id.value = "";
        modal.style.display = "flex";
    };

    //CERRAR MODAL
    document.querySelector("#cerrarModal").onclick = () => {
        modal.style.display = "none";
    };

    // GUARDAR (CREAR O EDITAR)
     form.onsubmit = async e => {
        e.preventDefault();

        let formData = new FormData();

        formData.append("id", form.id.value);
        formData.append("titulo", form.titulo.value);
        formData.append("categoria", form.categoria.value);
        formData.append("descripcion", form.descripcion.value);

        let archivo = document.querySelector("#archivo").files[0];
        if (archivo) {
            formData.append("archivo", archivo);
        }

        let method = form.id.value ? "POST_EDIT" : "POST_NEW";

        formData.append("method", method);

        await fetch("api.php", {
            method: "POST",
            body: formData
        });

        modal.style.display = "none";
        location.reload();

    };


    // EDITAR PRODUCTO 
    async function editar(id) {
        let res = await fetch("api.php");
        let productos = await res.json();
        let p = productos.find(item => item.id == id);

        form.id.value = p.id;
        form.titulo.value = p.titulo;
        form.categoria.value = p.categoria;
        form.descripcion.value = p.descripcion;
       // form.imagen.value = p.imagen;

        modal.style.display = "flex";

        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ELIMINAR 
    async function eliminar(id) {
        if (!confirm("¿Seguro que querés eliminar este producto?")) return;

        await fetch("api.php", {
            method: "DELETE",
            body: JSON.stringify({ id })
        });

        location.reload();

    }