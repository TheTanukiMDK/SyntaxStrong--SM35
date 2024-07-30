$(document).ready(function() {
    $('#clientesTable').DataTable();

    // Cargar los tipos de membresías al cargar la página
    fetch('../../connection/admin/get_tipos_membresias.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let tipoMembresiaSelect = document.getElementById('tipo_membresia');
                tipoMembresiaSelect.innerHTML = '<option selected disabled value="">Selecciona un tipo de membresía</option>';
                data.data.forEach(membresia => {
                    let option = document.createElement('option');
                    option.value = membresia.id_tipo_membresia;
                    option.text = `${membresia.tipo_membresia} - $${membresia.precio}`;
                    tipoMembresiaSelect.appendChild(option);
                });
            } else {
                alert('Error al obtener los tipos de membresías: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

    $('#addClientForm').on('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);
        $.ajax({
            url: form.action,
            type: form.method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    var newRow = `<tr>
                        <td>${data.id_cliente}</td>
                        <td>${formData.get('nombre')} ${formData.get('ap_paterno')} ${formData.get('ap_materno')}</td>
                        <td>${formData.get('curp')}</td>
                        <td>${formData.get('fecha_na')}</td>
                        <td>${formData.get('num_celular')}</td>
                        <td>${formData.get('sexo')}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="eliminarCliente(${data.id_cliente})"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-success btn-sm" onclick="actualizarCliente(${data.id_cliente})"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-info btn-sm" onclick="mostrarInscripcion(${data.id_cliente})"><i class="bi bi-journal-plus"></i></button>
                        </td>
                    </tr>`;
                    $('#clientesTable').DataTable().row.add($(newRow)).draw();
                    form.reset();
                    var addClientModal = bootstrap.Modal.getInstance(document.getElementById('addClientModal'));
                    addClientModal.hide();
                } else {
                    alert('Error al registrar cliente: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    $('#tipo_membresia').on('change', function() {
        var tipoMembresiaId = this.value;
        fetch(`../../connection/admin/get_tipos_membresias.php?id_tipo_membresia=${tipoMembresiaId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#costo').val(data.data.precio);
                } else {
                    alert('Error al obtener membresía: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    $('#fecha_inicio').on('change', function() {
        var fechaInicio = new Date(this.value);
        var fechaFin = new Date(fechaInicio);
        fechaFin.setMonth(fechaInicio.getMonth() + 1);
        $('#fecha_fin').val(fechaFin.toISOString().split('T')[0]);
    });

    $('#membershipForm').on('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);
        $.ajax({
            url: form.action,
            type: form.method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    alert('Membresía registrada correctamente');
                    var membershipModal = bootstrap.Modal.getInstance(document.getElementById('membershipModal'));
                    membershipModal.hide();
                } else {
                    alert('Error al registrar membresía: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    window.eliminarCliente = function(id) {
        if (confirm("¿Está seguro de que desea eliminar este cliente?")) {
            window.location.href = '../../connection/admin/delete_cliente.php?id=' + id;
        }
    }

    window.actualizarCliente = function(id) {
        window.location.href = '../../views/admin/update_cliente.php?id=' + id;
    }

    window.mostrarInscripcion = function(id) {
        document.getElementById('id_cliente_membresia').value = id;
        var membershipModal = new bootstrap.Modal(document.getElementById('membershipModal'));
        membershipModal.show();
    }
});
