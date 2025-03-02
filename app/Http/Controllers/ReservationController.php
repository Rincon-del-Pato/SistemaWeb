<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Customer;
use App\Models\Reservation;
use App\Enums\TableStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'table_id' => 'required|exists:tables,id',
            'num_guests' => 'required|integer|min:1',
            'reservation_time' => 'required|date|after:now',
        ]);

        try {
            DB::beginTransaction();

            // Verificar disponibilidad de mesa
            $table = Table::find($request->table_id);
            if (!$table || $table->status !== TableStatus::Disponible) {
                return response()->json([
                    'success' => false,
                    'message' => 'La mesa seleccionada no está disponible'
                ], 422);
            }

            // Buscar cliente existente por teléfono o crear uno nuevo
            $customer = Customer::where('phone', $request->customer_phone)->first();
            if (!$customer) {
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                ]);
            }

            // Crear reservación
            $reservation = Reservation::create([
                'customer_id' => $customer->id,
                'table_id' => $request->table_id,
                'num_guests' => $request->num_guests,
                'reservation_time' => $request->reservation_time,
                'status' => 'confirmed'
            ]);

            // Actualizar estado de la mesa
            $table->status = TableStatus::Reservado;
            $table->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reservación creada exitosamente',
                'reservation' => $reservation
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la reservación: ' . $e->getMessage()
            ], 500);
        }
    }
}