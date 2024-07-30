// add_c&m.js
function eliminarCliente(id) {
    if (confirm("¿Está seguro de que desea eliminar este cliente?")) {
        window.location.href = '../../connection/admin/delete_cliente.php?id=' + id;
    }
}

function actualizarCliente(id) {
    window.location.href = '../../views/admin/update_cliente.php?id=' + id;
}

document.getElementById('addClientForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var form = this;
    var formData = new FormData(form);
    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('id_cliente_membresia').value = data.id_cliente;
            var membershipModal = new bootstrap.Modal(document.getElementById('membershipModal'));
            var addClientModal = bootstrap.Modal.getInstance(document.getElementById('addClientModal')); // Obtener instancia del modal
            addClientModal.hide(); // Cerrar el modal de añadir cliente
            membershipModal.show(); // Mostrar el modal de membresía
        } else {
            alert('Error al registrar cliente: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

document.getElementById('tipo_membresia').addEventListener('change', function() {
    var costoInput = document.getElementById('costo');
    var tipoMembresia = this.value;
    var costo = 0;

    switch (tipoMembresia) {
        case '1': // Clasic
            costo = 50;
            break;
        case '2': // Premiun
            costo = 150;
            break;
        case '3': // Senior
            costo = 300;
            break;
    }

    costoInput.value = costo;
});

document.getElementById('fecha_inicio').addEventListener('change', function() {
    var fechaInicio = new Date(this.value);
    var fechaFin = new Date(fechaInicio);
    fechaFin.setMonth(fechaInicio.getMonth() + 1);
    document.getElementById('fecha_fin').value = fechaFin.toISOString().split('T')[0];
});
