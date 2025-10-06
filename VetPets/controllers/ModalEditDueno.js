// ModalEditDueno.js
document.addEventListener("DOMContentLoaded", () => {
  const botonesEditar = document.querySelectorAll(".btn-editar-dueno");

  botonesEditar.forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      console.log("Botón de editar dueño clickeado");

      // Tomar valores del dataset
      const id = btn.dataset.id;
      const nombre = btn.dataset.nombre;
      const apellido = btn.dataset.apellido;
      const correo = btn.dataset.correo;
      const telefono = btn.dataset.telefono;
      const direccion = btn.dataset.direccion;
      const sede = btn.dataset.sede;

      openEditDuenoModal(id, nombre, apellido, correo, telefono, direccion, sede);
    });
  });
});


function openEditDuenoModal(id, nombre, apellido, correo, telefono, direccion, id_sede) {
    document.getElementById("modal-edit-dueno").classList.remove("hidden");
    document.getElementById("modal-edit-dueno").classList.add("flex");

    document.getElementById("edit_id_dueno").value = id;
    document.getElementById("edit_nombre").value = nombre;
    document.getElementById("edit_apellido").value = apellido;
    document.getElementById("edit_correo").value = correo;
    document.getElementById("edit_telefono").value = telefono;
    document.getElementById("edit_direccion").value = direccion;
    document.getElementById("edit_id_sede").value = id_sede;
}

function closeEditDuenoModal() {
    document.getElementById("modal-edit-dueno").classList.add("hidden");
    document.getElementById("modal-edit-dueno").classList.remove("flex");
}

document.addEventListener("DOMContentLoaded", () => {
    const formCita = document.getElementById("form-edit-dueno");

    formCita.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id_dueno = document.getElementById("edit_id_dueno").value;
        const nombre = document.getElementById("edit_nombre").value.trim();
        const apellido = document.getElementById("edit_apellido").value.trim();
        const correo = document.getElementById("edit_correo").value.trim();
        const telefono = document.getElementById("edit_telefono").value.trim();
        const direccion = document.getElementById("edit_direccion").value.trim();
        const id_sede = document.getElementById("edit_id_sede").value;

        if (!nombre || !apellido || !correo || !telefono || !direccion || !id_sede) {
            Swal.fire("Error", "Todos los campos son obligatorios", "error");
            return;
        }

        try {
            const response = await fetch("../duenos/update.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id_dueno, nombre, apellido, correo, telefono, direccion, id_sede })
            });

            const result = await response.json();

            if (result.success) {
                Swal.fire("Éxito", result.message, "success").then(() => {
                    closeEditDuenoModal();
                    loadPage("templates/gestion_duenos.php"); // recarga el dashboard
                });
            } else {
                Swal.fire("Error", result.message || "No se pudo actualizar", "error");
            }
        } catch (error) {
            Swal.fire("Error", "No se pudo conectar con el servidor", "error");
            console.error(error);
        }
    });
});
