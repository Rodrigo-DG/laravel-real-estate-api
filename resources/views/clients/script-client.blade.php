@section('scripts')
<script>
    console.log('Script cargado Client');

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof csrfToken === 'undefined') {
            console.error('CSRF token is not defined.');
            return;
        }

        // Obtén el cuerpo de la página
        const body = document.querySelector('body');
        if (body.classList.contains('manage-view')) {

            document.getElementById('clientForm').addEventListener('submit', function(event) {
                console.log('Formulario enviado');

                event.preventDefault(); // Previene el envío tradicional del formulario

                var formData = new FormData(this);
                var formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });

                var clientId = document.getElementById('client_id').value;
                var url = '{{ route("create-client.clients") }}';
                var method = 'POST';

                if (clientId) {
                    url = '{{ route("update-client.clients", ":id") }}'.replace(':id', clientId);
                }

                fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw data; // Lanza los datos de error para ser capturados en el catch
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response:', data);
                    
                    // Verifica si hay errores en la respuesta
                    if (data.errors) {
                        // Limpia los mensajes de error previos
                        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

                        // Muestra los errores en la vista
                        for (const [key, messages] of Object.entries(data.errors)) {
                            const errorField = document.getElementById(`error-${key}`);
                            if (errorField) {
                                errorField.textContent = messages[0]; // Muestra el primer mensaje de error
                            }
                        }
                    } else if (data.response && data.response.client) { // Verifica que data.response exista
                        toastr.success(data.response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('index.clients') }}"; 
                        }, 2000);
                    } else {
                        toastr.error(data.response ? data.response.message : 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (error.errors) {
                        // Muestra los errores en la vista
                        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

                        for (const [key, messages] of Object.entries(error.errors)) {
                            const errorField = document.getElementById(`error-${key}`);
                            if (errorField) {
                                errorField.textContent = messages[0]; // Muestra el primer mensaje de error
                            }
                        }
                    } else {
                        toastr.error('Ha ocurrido un error inesperado.');
                    }
                });
            });
        }
        
        if (body.classList.contains('index-view')) {

            deleteClientModal.addEventListener('show.bs.modal', function (event) {

                const button = event.relatedTarget;
                
                const clientId = button.getAttribute('data-client-id');
                const clientName = button.getAttribute('data-client-name');

                // Actualizar el título del modal
                const modalTitle = deleteClientModal.querySelector('.modal-title');
                modalTitle.textContent = `¿Desea eliminar al cliente "${clientName}"?`;

                // Actualizar el botón de confirmación para que incluya el ID del cliente
                const confirmDeleteButton = document.getElementById('confirmDeleteButton');
                confirmDeleteButton.onclick = function () {
                  
                    // Realizar la solicitud para eliminar al cliente
                    fetch(`/clients/delete-client/${clientId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.client) {
                            toastr.success(data.message);
                            setTimeout(function() {
                                window.location.href = "{{ route('index.clients') }}"; 
                            }, 2000);  
                        } else {
                            toastr.error(data.message);
                        }
                    })
                    .catch(error => {
                        toastr.error('Error en la eliminación del cliente.');
                        console.error('Error:', error);
                    });
                };
            });
        }
    });
</script>
@endsection