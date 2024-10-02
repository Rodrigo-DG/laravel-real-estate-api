@section('scripts')
<script>
    console.log('Script cargado Visit');

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof csrfToken === 'undefined') {
            console.error('CSRF token is not defined.');
            return;
        }

        // Obtén el cuerpo de la página
        const body = document.querySelector('body');
        if (body.classList.contains('manage-view')) {

            document.getElementById('visitForm').addEventListener('submit', function(event) {
                console.log('Formulario enviado');

                event.preventDefault(); // Previene el envío tradicional del formulario

                var formData = new FormData(this);
                var formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });

                var visitId = document.getElementById('visit_id').value;
                var url = '{{ route("create-visit.visits") }}';
                var method = 'POST';

                if (visitId) {
                    url = '{{ route("update-visit.visits", ":id") }}'.replace(':id', visitId);
                }

                console.log(Array.from(formData.entries()));

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
                    if (data.response && data.response.visit) {
                        toastr.success(data.response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('index.visits') }}"; 
                        }, 2000);
                    } else {
                        toastr.error(data.response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Limpia los mensajes de error previos
                    document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

                    // Muestra los errores en la vista si están disponibles
                    if (error.response && error.response.errors) {
                        for (const [key, messages] of Object.entries(error.response.errors)) {
                            const errorField = document.getElementById(`error-${key}`);
                            if (errorField) {
                                errorField.textContent = messages[0]; // Muestra el primer mensaje de error
                            }
                        }
                    } else {
                        toastr.error(error.message || 'Error en la creación o actualización de la visita.');
                    }
                });
            });
        }
        
        if (body.classList.contains('index-view')) {

            deleteVisitModal.addEventListener('show.bs.modal', function (event) {

                const button = event.relatedTarget;
                
                const visitId = button.getAttribute('data-visit-id');

                // Actualizar el título del modal
                const modalTitle = deleteVisitModal.querySelector('.modal-title');
                modalTitle.textContent = `¿Desea eliminar la visita N° "${visitId}"?`;

                // Actualizar el botón de confirmación para que incluya el ID de la visita
                const confirmDeleteButton = document.getElementById('confirmDeleteButton');
                confirmDeleteButton.onclick = function () {
                  
                    // Realizar la solicitud para eliminar la visita
                    fetch(`/visits/delete-visit/${visitId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.visit) {
                            toastr.success(data.message);
                            setTimeout(function() {
                                window.location.href = "{{ route('index.visits') }}"; 
                            }, 2000);  
                        } else {
                            toastr.error(data.message);
                        }
                    })
                    .catch(error => {
                        toastr.error('Error en la eliminación de la visita.');
                        console.error('Error:', error);
                    });
                };
            });
        }
    });
</script>
@endsection