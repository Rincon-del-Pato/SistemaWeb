
<div class="p-4">
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p class="font-bold">Serie-Número:</p>
            <p>{{ $invoice->series }}-{{ str_pad($invoice->number, 8, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div>
            <p class="font-bold">Tipo:</p>
            <p>{{ $invoice->formatted_type }}</p>
        </div>
        <div>
            <p class="font-bold">Cliente:</p>
            <p>{{ $invoice->customer_name }}</p>
        </div>
        <div>
            <p class="font-bold">{{ $invoice->customer_document_type }}:</p>
            <p>{{ $invoice->customer_document_number }}</p>
        </div>
        <div>
            <p class="font-bold">Fecha:</p>
            <p>{{ $invoice->issue_date->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Cant.</th>
                    <th class="px-4 py-2 text-left">Descripción</th>
                    <th class="px-4 py-2 text-right">P.U.</th>
                    <th class="px-4 py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($invoice->items as $item)
                    <tr>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">{{ $item->description }}</td>
                        <td class="px-4 py-2 text-right">S/ {{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-4 py-2 text-right">S/ {{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-right">
        <p>Sub Total: S/ {{ number_format($invoice->total / 1.18, 2) }}</p>
        <p>IGV (18%): S/ {{ number_format($invoice->tax, 2) }}</p>
        <p class="font-bold">Total: S/ {{ number_format($invoice->total, 2) }}</p>
    </div>
</div>
