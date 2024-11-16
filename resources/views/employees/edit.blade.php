@extends('adminlte::page')

@section('title', 'Empleados')

@section('content')
<div class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Editar Empleado</h1>
            <p class="mt-1 text-sm text-gray-600">Modifica los datos del empleado según sea necesario</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <form method="POST" action="{{ route('employees.update', $employee) }}" role="form" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                @include('employees.form')
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #f8fafc;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
        
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modal-image');
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
            
            // Cerrar modal al hacer clic fuera de la imagen
            modal.onclick = function(e) {
                if (e.target === modal) {
                    closeImageModal();
                }
                e.preventDefault(); // Prevenir navegación
            }

            // Cerrar modal con tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        }

        function closeImageModal(e) {
            if (e) e.preventDefault(); // Prevenir navegación si viene de un evento
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Vista previa de la imagen seleccionada
        document.getElementById('profile_photo_path').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview-image');
                    if (preview) {
                        preview.src = e.target.result;
                    } else {
                        // Crear preview si no existe
                        const newPreview = document.createElement('img');
                        newPreview.src = e.target.result;
                        newPreview.id = 'preview-image';
                        newPreview.className = 'object-cover w-32 h-32 border border-gray-200 rounded-lg cursor-pointer hover:opacity-75';
                        newPreview.onclick = function() { openImageModal(this.src); };
                        document.querySelector('.space-y-4').insertBefore(newPreview, document.querySelector('label[for="profile_photo_path"]'));
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@stop
