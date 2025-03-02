<?php

namespace App\Http\Controllers;

use App\Enums\OrderType;
use App\Enums\CommandStatus;
use Illuminate\Http\Request;
use App\Models\CommandTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommandController extends Controller
{
    public function index()
    {
        $commands = CommandTicket::with(['order.table', 'items.menuItem', 'logs'])
            ->latest()
            ->get()
            ->groupBy('status');

        return view('commands.index', compact('commands'));
    }

    public function show(CommandTicket $command)
    {
        $command->load(['order.table', 'items.menuItem', 'logs']);

        return response()->json([
            'id' => $command->id,
            'status' => $command->status,
            'order' => [
                'type' => $command->order->order_type->value,
                'info' => $this->getOrderInfo($command->order),
                'items' => $command->items->map(function ($item) {
                    return [
                        'quantity' => $item->quantity,
                        'menu_item' => [
                            'name' => $item->menuItem->name
                        ],
                        'special_requests' => $item->special_requests ?? ''
                    ];
                })
            ]
        ]);
    }

    private function getOrderInfo($order)
    {
        $info = [];

        switch ($order->order_type->value) {
            case 'Local':
                $info = [
                    'table_number' => $order->table ? $order->table->table_number : 'N/A',
                    'num_guests' => $order->num_guests ?? 0
                ];
                break;
            case 'ParaLlevar':
                $info = [
                    'special_instructions' => $order->special_instructions ?? ''
                ];
                break;
            case 'Delivery':
                $info = [
                    'customer_name' => $order->customer_name ?? 'N/A',
                    'delivery_address' => $order->delivery_address ?? 'N/A',
                    'special_instructions' => $order->special_instructions ?? ''
                ];
                break;
        }

        return $info;
    }

    public function updateStatus(Request $request, CommandTicket $command)
    {
        try {
            DB::beginTransaction();

            $oldStatus = $command->status;
            $newStatus = $request->status;

            // Solo validar contra un array de strings permitidos
            $allowedStatuses = ['Pendiente', 'En_Progreso', 'Completado'];
            if (!in_array($newStatus, $allowedStatuses)) {
                throw new \Exception('Estado no válido');
            }

            $command->update(['status' => $newStatus]);

            $command->logs()->create([
                'command_ticket_id' => $command->id,
                'previous_status' => $oldStatus,
                'new_status' => $newStatus,
                'change_date' => now(),
                'notes' => 'Cambio de estado manual'
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en actualización: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // No necesitamos estos métodos por ahora ya que las comandas se crean desde las órdenes
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
