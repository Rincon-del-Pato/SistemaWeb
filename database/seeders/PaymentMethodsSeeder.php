<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('payment_methods')->insert([
            ['method_name' => 'Efectivo', 'description' => 'Pago en efectivo al momento de la entrega, común en servicios de entrega a domicilio.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['method_name' => 'Yape', 'description' => 'Método de pago móvil muy popular en Perú, vinculado a cuentas bancarias.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['method_name' => 'Plin', 'description' => 'Sistema de pago móvil interbancario en Perú, también vinculado a cuentas bancarias.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['method_name' => 'Blim', 'description' => 'Aplicación de pagos y transferencias móviles en Perú, con opciones de pago de servicios.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['method_name' => 'Transferencia Bancaria', 'description' => 'Pago mediante transferencia directa entre cuentas bancarias.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['method_name' => 'Tarjeta de Crédito', 'description' => 'Pago con tarjetas de crédito internacionales o locales, como Visa, MasterCard, etc.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['method_name' => 'Tarjeta de Débito', 'description' => 'Pago con tarjetas de débito vinculadas a cuentas bancarias.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // ['method_name' => 'Pago Contra Entrega', 'description' => 'Opción de pagar al momento de recibir el pedido, solo en efectivo o con tarjeta.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // ['method_name' => 'PayPal', 'description' => 'Método de pago internacional, popular en pagos en línea y transferencias.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // ['method_name' => 'MercadoPago', 'description' => 'Método de pago utilizado en plataformas de comercio electrónico, especialmente en América Latina.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
