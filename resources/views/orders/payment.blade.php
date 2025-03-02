@extends('adminlte::page')

@section('title', 'Procesar Pago')

@section('content')
    <!-- Modificar la estructura principal para mejor responsive -->
    <div class="container p-4 mx-auto">
        <div class="flex flex-col gap-4 lg:flex-row">
            <!-- Panel de Productos - ajustado para diferentes pantallas -->
            <div class="w-full overflow-x-auto bg-white rounded-lg shadow-md lg:w-2/3">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">Detalle del Pedido</h3>
                    @if($order->order_type === 'Local')
                        <p class="text-sm text-gray-600">Mesa: {{ $order->table->table_number }}</p>
                    @else
                        <p class="text-sm text-gray-600">Tipo: {{ $order->order_type }}</p>
                    @endif
                    <p class="text-sm text-gray-600">Mozo: {{ $order->user->name }}</p>
                </div>
                <div class="p-4">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Cant.</th>
                                <th class="px-4 py-2 text-left">Producto</th>
                                <th class="px-4 py-2 text-right">P.U.</th>
                                <th class="px-4 py-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2">{{ $item->menuItem->name }}</td>
                                    <td class="px-4 py-2 text-right">S/. {{ number_format($item->price, 2) }}</td>
                                    <td class="px-4 py-2 text-right">S/.
                                        {{ number_format($item->quantity * $item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4 mt-4 rounded-lg bg-gray-50">
                        <div class="flex justify-between">
                            <span class="font-bold">Total:</span>
                            <span class="text-xl font-bold">S/. {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel de Pago - ajustado para diferentes pantallas -->
            <div class="w-full bg-white rounded-lg shadow-md lg:w-1/3">
                <form id="paymentForm">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="total" value="{{ $order->total }}">

                    <!-- Modificar el botón de Cliente General para que sea más visible -->
                    <div class="px-4 py-2 border-b bg-gray-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800">Datos de Facturación</h3>
                            <button type="button" onclick="setDefaultCustomer()" id="defaultCustomerBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="mr-2 fas fa-user-circle"></i>Cliente General
                            </button>
                        </div>
                    </div>

                    <!-- Reemplazar la sección de tipo de comprobante y campos del cliente -->
                    <div class="p-4 space-y-4">
                        <!-- Tipo de Comprobante -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-bold text-gray-700">Tipo de Comprobante</label>
                            <div class="grid grid-cols-2 gap-4">
                                <button type="button" onclick="setInvoiceType('boleta')" id="boletaBtn"
                                    class="p-3 text-sm font-semibold transition-colors border rounded-lg focus:outline-none">
                                    Boleta
                                </button>
                                <button type="button" onclick="setInvoiceType('factura')" id="facturaBtn"
                                    class="p-3 text-sm font-semibold transition-colors border rounded-lg focus:outline-none">
                                    Factura
                                </button>
                            </div>
                            <input type="hidden" name="invoice_type" id="invoice_type" value="boleta">
                        </div>

                        <!-- Campos del Cliente -->
                        <div id="customerFields" class="space-y-4">
                            <div id="documentSearchSection">
                                <label class="block mb-2 text-sm font-bold text-gray-700" id="document_label">DNI</label>
                                <div class="flex gap-2">
                                    <input type="text" name="customer_document_number" id="customer_document_number"
                                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" maxlength="8"
                                        placeholder="Ingrese DNI" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <button type="button" onclick="consultDocument()"
                                        class="px-4 py-2 text-white transition-colors bg-blue-500 rounded-lg hover:bg-blue-600">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="customer_document_type" id="customer_document_type"
                                    value="DNI">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700" id="nameLabel">Nombre
                                    Cliente</label>
                                <input type="text" name="customer_name" id="customer_name"
                                    class="w-full p-2 border rounded-lg bg-gray-50" readonly>
                            </div>

                            <div id="addressField" class="hidden">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Dirección Fiscal</label>
                                <input type="text" name="customer_address" id="customer_address"
                                    class="w-full p-2 border rounded-lg bg-gray-50" readonly>
                            </div>
                        </div>

                        <!-- Método de Pago -->
                        <div class="pt-4 border-t">
                            <label class="block mb-2 text-sm font-bold text-gray-700">Método de Pago</label>
                            <select name="payment_method_id" id="payment_method"
                                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                onchange="handlePaymentMethodChange()">
                                @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                @endforeach
                            </select>

                            <!-- Modificar la sección de pago en efectivo -->
                            <div id="cashPaymentSection" class="hidden p-4 mt-4 border rounded-lg bg-gray-50">
                                <div class="space-y-4">
                                    <!-- Botones de monto rápido -->
                                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                                        @foreach ([10, 20, 50, 100] as $amount)
                                            <button type="button" onclick="setQuickAmount({{ $amount }})"
                                                class="p-2 font-bold text-center transition-colors bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-100">
                                                S/{{ $amount }}
                                            </button>
                                        @endforeach
                                    </div>

                                    <!-- Campo de monto recibido -->
                                    <div class="grid items-center grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div class="space-y-1">
                                            <label class="block text-sm font-bold text-gray-700">Monto Recibido:</label>
                                            <div class="relative">
                                                <input type="number" id="amountReceived"
                                                    class="w-full p-2 text-right border rounded-lg focus:ring-2 focus:ring-blue-500"
                                                    onchange="calculateChange()" oninput="validateAmount(this)"
                                                    step="0.1" min="{{ $order->total }}" required>
                                                <div id="amountError" class="hidden mt-1 text-sm text-red-500">
                                                    El monto debe ser mayor o igual a S/.
                                                    {{ number_format($order->total, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <label class="block text-sm font-bold text-gray-700">Vuelto:</label>
                                            <span id="change" class="block text-xl font-bold text-green-600">S/.
                                                0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen -->
                    <div class="p-3 mt-4 space-y-2 rounded-lg bg-gray-50">
                        <div class="flex justify-between text-sm">
                            <span>Subtotal:</span>
                            <span>S/. {{ number_format($order->total / 1.18, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>IGV (18%):</span>
                            <span>S/. {{ number_format($order->total - $order->total / 1.18, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-2 text-lg font-bold border-t">
                            <span>Total a Pagar:</span>
                            <span id="finalTotal">S/. {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>

                    <button type="button" onclick="processPayment()"
                        class="w-full px-4 py-3 font-bold text-white bg-green-600 rounded-md hover:bg-green-700">
                        Procesar Pago e Imprimir
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <style>
        .btn-default-customer {
            transition: all 0.3s ease;
        }

        .btn-default-customer:hover {
            background-color: #e5e7eb;
            transform: translateY(-1px);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        let totalAmount = {{ $order->total }};

        function resetFields() {
            document.getElementById('customer_document_number').value = '';
            document.getElementById('customer_name').value = '';
            document.getElementById('customer_address').value = '';
        }

        function handleDocumentTypeChange() {
            const invoiceType = document.getElementById('invoice_type').value;
            const documentInput = document.getElementById('customer_document_number');
            const documentLabel = document.getElementById('document_label');
            const addressField = document.getElementById('addressField');
            const nameLabel = document.getElementById('nameLabel');

            // Limpiar valores
            documentInput.value = '';
            document.getElementById('customer_name').value = '';
            document.getElementById('customer_address').value = '';

            let config;
            if (invoiceType === 'boleta') {
                config = {
                    label: 'DNI',
                    type: 'DNI',
                    maxLength: 8,
                    placeholder: 'Ingrese DNI',
                    nameLabel: 'Nombre Cliente',
                    showAddress: false
                };
            } else {
                config = {
                    label: 'RUC',
                    type: 'RUC',
                    maxLength: 11,
                    placeholder: 'Ingrese RUC',
                    nameLabel: 'Razón Social',
                    showAddress: true
                };
            }

            // Aplicar configuración
            documentLabel.textContent = config.label;
            document.getElementById('customer_document_type').value = config.type;
            documentInput.maxLength = config.maxLength;
            documentInput.minLength = config.maxLength;
            documentInput.placeholder = config.placeholder;
            nameLabel.textContent = config.nameLabel;
            addressField.style.display = config.showAddress ? 'block' : 'none';

            // Limpiar y enfocar el campo de documento
            documentInput.value = '';
            setTimeout(() => documentInput.focus(), 100);
        }

        // Asegurarse de que el evento se asigne correctamente
        document.addEventListener('DOMContentLoaded', function() {
            const invoiceSelect = document.getElementById('invoice_type');

            // Remover eventos anteriores si existen
            invoiceSelect.removeEventListener('change', handleDocumentTypeChange);

            // Agregar el nuevo evento
            invoiceSelect.addEventListener('change', handleDocumentTypeChange);

            // Ejecutar la configuración inicial
            handleDocumentTypeChange();
            handlePaymentMethodChange();
        });

        function handlePaymentMethodChange() {
            const paymentMethod = document.getElementById('payment_method').value;
            const cashPaymentSection = document.getElementById('cashPaymentSection');
            cashPaymentSection.style.display = paymentMethod === '1' ? 'block' : 'none';
        }

        function setQuickAmount(amount) {
            const input = document.getElementById('amountReceived');
            input.value = amount;
            validateAmount(input);
        }

        function calculateChange() {
            const amountReceived = parseFloat(document.getElementById('amountReceived').value) || 0;
            const change = amountReceived - totalAmount;

            // Actualizar el display del vuelto
            const changeDisplay = document.getElementById('change');
            if (change >= 0) {
                changeDisplay.textContent = `S/. ${change.toFixed(2)}`;
                changeDisplay.classList.remove('text-red-600');
                changeDisplay.classList.add('text-green-600');
            } else {
                changeDisplay.textContent = `S/. 0.00`;
                changeDisplay.classList.remove('text-green-600');
                changeDisplay.classList.add('text-red-600');
            }
        }

        async function consultDocument() {
            const documentType = document.getElementById('customer_document_type').value;
            const documentNumber = document.getElementById('customer_document_number').value;
            const invoiceType = document.getElementById('invoice_type').value;

            if (!documentNumber) {
                Swal.fire('Error', 'Ingrese un número de documento', 'error');
                return;
            }

            if ((documentType === 'DNI' && documentNumber.length !== 8) ||
                (documentType === 'RUC' && documentNumber.length !== 11)) {
                Swal.fire('Error', `El ${documentType} debe tener ${documentType === 'DNI' ? '8' : '11'} dígitos`,
                    'error');
                return;
            }

            try {
                Swal.fire({
                    title: 'Consultando...',
                    text: 'Por favor espere',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(`/consulta-documento/${documentType}/${documentNumber}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();
                Swal.close();

                if (data.success) {
                    document.getElementById('customer_name').value = data.name;
                    const addressField = document.getElementById('addressField');

                    if (invoiceType === 'factura') {
                        document.getElementById('customer_address').value = data.address || '';
                        addressField.style.display = 'block';

                        if (!data.address) {
                            Swal.fire('Advertencia', 'No se encontró dirección fiscal', 'warning');
                        }
                        if (data.condition !== 'ACTIVO' || data.state !== 'ACTIVO') {
                            Swal.fire('Advertencia', 'El RUC no está activo o habido', 'warning');
                        }
                    } else {
                        addressField.style.display = 'none';
                    }
                } else {
                    Swal.fire('Error', data.message || 'No se encontró información', 'error');
                }
            } catch (error) {
                Swal.close();
                console.error('Error:', error);
                Swal.fire('Error', 'Error al consultar el documento', 'error');
            }
        }

        function processPayment() {
            const form = document.getElementById('paymentForm');
            const formData = new FormData(form);
            const data = {};

            // Convertir FormData a objeto plano y agregar el token CSRF
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Obtener el token CSRF del meta tag
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Validaciones básicas
            if (!data.payment_method_id) {
                Swal.fire('Error', 'Seleccione un método de pago', 'error');
                return;
            }

            if (!data.customer_document_number || !data.customer_name) {
                Swal.fire('Error', 'Complete los datos del cliente', 'error');
                return;
            }

            // Mostrar loading
            Swal.fire({
                title: 'Procesando pago...',
                text: 'Por favor espere',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Enviar petición
            fetch(`/orders/${data.order_id}/process-payment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(async response => {
                const responseData = await response.json();
                if (!response.ok) {
                    throw new Error(responseData.message || 'Error en el servidor');
                }
                return responseData;
            })
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        title: '¡Pago procesado!',
                        text: 'El comprobante se abrirá en una nueva ventana',
                        icon: 'success',
                        showConfirmButton: true
                    }).then(() => {
                        window.open(data.invoice_url, '_blank');
                        window.location.href = '{{ route('orders.index') }}';
                    });
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Error al procesar el pago',
                    icon: 'error'
                });
            });
        }

        function setInvoiceType(type) {
            // Actualizar tipo de documento
            document.getElementById('invoice_type').value = type;

            // Actualizar apariencia de botones
            document.getElementById('boletaBtn').classList.toggle('bg-blue-500', type === 'boleta');
            document.getElementById('boletaBtn').classList.toggle('text-white', type === 'boleta');
            document.getElementById('facturaBtn').classList.toggle('bg-blue-500', type === 'factura');
            document.getElementById('facturaBtn').classList.toggle('text-white', type === 'factura');

            // Desactivar Cliente General si está activo
            const defaultCustomerBtn = document.getElementById('defaultCustomerBtn');
            if (defaultCustomerBtn.classList.contains('bg-blue-500')) {
                setDefaultCustomer(); // Esto desactivará el modo Cliente General
            }

            handleDocumentTypeChange();
            document.getElementById('documentSearchSection').style.display = 'block';
        }

        function handleDocumentTypeChange() {
            const invoiceType = document.getElementById('invoice_type').value;
            const documentNumber = document.getElementById('customer_document_number');
            const documentLabel = document.getElementById('document_label');
            const addressField = document.getElementById('addressField');
            const nameLabel = document.getElementById('nameLabel');
            const isDefaultCustomer = documentNumber.value === '00000000';

            // Solo resetear campos si no es Cliente General
            if (!isDefaultCustomer) {
                resetFields();
            }

            // Configurar campos según tipo de comprobante
            if (invoiceType === 'boleta') {
                documentLabel.textContent = 'DNI';
                documentNumber.maxLength = 8;
                documentNumber.placeholder = 'Ingrese DNI';
                nameLabel.textContent = 'Nombre Cliente';
                addressField.classList.add('hidden');
                document.getElementById('customer_document_type').value = 'DNI';
            } else {
                documentLabel.textContent = 'RUC';
                documentNumber.maxLength = 11;
                documentNumber.placeholder = 'Ingrese RUC';
                nameLabel.textContent = 'Razón Social';
                addressField.classList.remove('hidden');
                document.getElementById('customer_document_type').value = 'RUC';
            }

            // Solo enfocar si no es Cliente General
            if (!isDefaultCustomer) {
                documentNumber.focus();
            }
        }

        function handlePaymentMethodChange() {
            const paymentMethod = document.getElementById('payment_method').value;
            const cashPaymentSection = document.getElementById('cashPaymentSection');

            if (paymentMethod === '1') { // Efectivo
                cashPaymentSection.classList.remove('hidden');
                cashPaymentSection.classList.add('animate-fade-in');
            } else {
                cashPaymentSection.classList.add('hidden');
                cashPaymentSection.classList.remove('animate-fade-in');
                // Resetear campos de pago en efectivo
                document.getElementById('amountReceived').value = '';
                document.getElementById('change').textContent = 'S/. 0.00';
            }
        }

        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            setInvoiceType('boleta');
            handlePaymentMethodChange();
        });

        function validateAmount(input) {
            const amount = parseFloat(input.value) || 0;
            const errorDiv = document.getElementById('amountError');
            const submitButton = document.querySelector('button[onclick="processPayment()"]');

            if (amount < totalAmount) {
                input.classList.add('border-red-500', 'bg-red-50');
                errorDiv.classList.remove('hidden');
                submitButton.disabled = true;
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                input.classList.remove('border-red-500', 'bg-red-50');
                errorDiv.classList.add('hidden');
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            calculateChange();
        }

        function setQuickAmount(amount) {
            const input = document.getElementById('amountReceived');
            input.value = amount;
            validateAmount(input);
        }

        function calculateChange() {
            const amountReceived = parseFloat(document.getElementById('amountReceived').value) || 0;
            const change = amountReceived - totalAmount;

            // Actualizar el display del vuelto
            const changeDisplay = document.getElementById('change');
            if (change >= 0) {
                changeDisplay.textContent = `S/. ${change.toFixed(2)}`;
                changeDisplay.classList.remove('text-red-600');
                changeDisplay.classList.add('text-green-600');
            } else {
                changeDisplay.textContent = `S/. 0.00`;
                changeDisplay.classList.remove('text-green-600');
                changeDisplay.classList.add('text-red-600');
            }
        }

        // Inicializar validaciones al cargar
        document.addEventListener('DOMContentLoaded', function() {
            // ...existing initialization code...

            const amountInput = document.getElementById('amountReceived');
            if (amountInput) {
                amountInput.addEventListener('input', () => validateAmount(amountInput));
            }
        });

        // Agregar función para cliente general
        function setDefaultCustomer() {
            const documentSearchSection = document.getElementById('documentSearchSection');
            const defaultCustomerBtn = document.getElementById('defaultCustomerBtn');

            // Limpiar campos siempre
            resetFields();

            // Si NO está activo el botón de Cliente General, activarlo
            if (!defaultCustomerBtn.classList.contains('bg-blue-500')) {
                document.getElementById('customer_document_number').value = '00000000';
                document.getElementById('customer_name').value = 'Cliente General';
                defaultCustomerBtn.classList.add('bg-blue-500', 'text-white');
                documentSearchSection.style.display = 'none';
            } else {
                // Si está activo, desactivarlo y mostrar campos de búsqueda
                defaultCustomerBtn.classList.remove('bg-blue-500', 'text-white');
                documentSearchSection.style.display = 'block';
                handleDocumentTypeChange(); // Restaurar campos según el tipo de comprobante actual
            }
        }

        // Modificar el event listener inicial
        document.addEventListener('DOMContentLoaded', function() {
            // ...existing initialization code...

            // Agregar botón para salir de modo Cliente General
            const clienteGeneralBtn = document.querySelector('button[onclick="setDefaultCustomer()"]');
            clienteGeneralBtn.addEventListener('dblclick', exitDefaultCustomer);
        });
    </script>

    <!-- Agregar estilos para mejorar la visualización -->
    <style>
        .cliente-general-active {
            background-color: #f3f4f6;
            border: 2px solid #60a5fa;
        }

        .payment-method-active {
            background-color: #e5e7eb;
            border-color: #60a5fa;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
@stop
