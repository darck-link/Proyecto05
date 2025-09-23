<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Nuevo Servicio</h2>
                <p class="text-sm text-gray-600 mt-1">Agrega un nuevo servicio al sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header del Formulario -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <span class="text-blue-600">📋</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Crear Nuevo Servicio</h3>
                                <p class="text-sm text-gray-600">Completa la información del servicio</p>
                            </div>
                        </div>
                        <a href="{{ route('servicios.index') }}" 
                           class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg border flex items-center gap-2 transition duration-150">
                            ← Volver al listado
                        </a>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="p-6">
                    <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="servicioForm">
                        @csrf

                        <!-- Nombre -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <span>📛</span>
                                Nombre del Servicio
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" required placeholder="Ej: Mantenimiento Técnico" 
                                   maxlength="100"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                            <div class="text-xs text-gray-500 mt-1 flex justify-between">
                                <span>Máximo 100 caracteres</span>
                                <span id="nombreCounter">0/100</span>
                            </div>
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <span>📝</span>
                                Descripción
                            </label>
                            <textarea name="descripcion" placeholder="Describe el servicio..." rows="4"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"></textarea>
                            <div class="text-xs text-gray-500 mt-1">Opcional - Ayuda a los usuarios a entender el servicio</div>
                        </div>

                        <!-- Horario -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <span>⏰</span>
                                Horario
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="horario" required 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                                <option value="">Selecciona un horario...</option>
                                <option value="Lunes a Viernes: 8:00 - 18:00">Lunes a Viernes: 8:00 - 18:00</option>
                                <option value="Lunes a Sábado: 9:00 - 17:00">Lunes a Sábado: 9:00 - 17:00</option>
                                <option value="24/7">24/7</option>
                                <option value="Fines de semana: 10:00 - 16:00">Fines de semana: 10:00 - 16:00</option>
                                <option value="Personalizado">Personalizado</option>
                            </select>
                            @error('horario')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <span>🖼️</span>
                                Imagen del Servicio
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition duration-150">
                                <input type="file" name="imagen" id="imagen" accept="image/*" 
                                       class="hidden" onchange="previewImage(this)">
                                <label for="imagen" class="cursor-pointer">
                                    <div class="text-4xl mb-2">📁</div>
                                    <p class="text-gray-600">Haz clic para subir una imagen</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Máx. 2MB)</p>
                                </label>
                            </div>
                            <div id="imagePreview" class="mt-3 hidden">
                                <img id="preview" class="w-32 h-32 object-cover rounded-lg border">
                                <button type="button" onclick="removeImage()" class="text-red-500 text-sm mt-2">🗑️ Eliminar imagen</button>
                            </div>
                            @error('imagen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-3 pt-4">
                            <button type="reset" 
                                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition duration-150">
                                🔄 Limpiar
                            </button>
                            <button type="submit" 
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition duration-150 flex items-center justify-center gap-2">
                                💾 Guardar Servicio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Contador de caracteres para el nombre
        document.querySelector('input[name="nombre"]').addEventListener('input', function() {
            const counter = document.getElementById('nombreCounter');
            counter.textContent = this.value.length + '/100';
        });

        // Previsualización de imagen
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('imagen').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
        }

        // Validación del formulario
        document.getElementById('servicioForm').addEventListener('submit', function(e) {
            const nombre = document.querySelector('input[name="nombre"]').value.trim();
            const horario = document.querySelector('select[name="horario"]').value;
            
            if (!nombre) {
                e.preventDefault();
                alert('Por favor ingresa el nombre del servicio');
                return false;
            }
            
            if (!horario) {
                e.preventDefault();
                alert('Por favor selecciona un horario');
                return false;
            }
        });
    </script>
</x-app-layout>