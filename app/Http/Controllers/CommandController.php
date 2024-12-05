<?php

namespace App\Http\Controllers;

use App\Models\CommandTicket;
use Illuminate\Http\Request;
use App\Enums\CommandStatus;
use Illuminate\Support\Facades\DB;

class CommandController extends Controller
{
    public function index()
    {
        $commands = CommandTicket::with(['order', 'items.menuItem', 'logs'])
            ->latest()
            ->get()
            ->groupBy('status');

        return view('commands.index', compact('commands'));
    }

    public function show(CommandTicket $command)
    {
        $command->load(['order', 'items.menuItem', 'logs']);
        return response()->json($command);
    }

    public function updateStatus(Request $request, CommandTicket $command)
    {
        try {
            DB::beginTransaction();

            $previousStatus = $command->status;
            $newStatus = CommandStatus::from($request->status);

            // Actualizar el estado
            $command->update([
                'status' => $newStatus
            ]);

            // Registrar el cambio en el log
            $command->logs()->create([
                'command_ticket_id' => $command->id,
                'previous_status' => $previousStatus,
                'new_status' => $newStatus,
                'change_date' => now(),
                'notes' => $request->notes ?? 'Cambio de estado'
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado: ' . $e->getMessage()
            ], 500);
        }
    }

    // No necesitamos estos métodos por ahora ya que las comandas se crean desde las órdenes
    public function create() { }
    public function store(Request $request) { }
    public function edit(string $id) { }
    public function update(Request $request, string $id) { }
    public function destroy(string $id) { }
}
