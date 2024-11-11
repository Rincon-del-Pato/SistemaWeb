<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('menu_items')->insert([
            // Bebidas
            ['category_id' => 1, 'name' => 'Pepsi', 'description' => 'Refresco de cola', 'image_url' => 'https://example.com/pepsi.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Fanta', 'description' => 'Refresco de naranja', 'image_url' => 'https://example.com/fanta.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Sprite', 'description' => 'Refresco de limón', 'image_url' => 'https://example.com/sprite.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Coca-Cola', 'description' => 'Refresco de cola', 'image_url' => 'https://example.com/coca_cola.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Agua Mineral', 'description' => 'Agua embotellada sin gas', 'image_url' => 'https://example.com/agua_mineral.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Agua con Gas', 'description' => 'Agua embotellada con gas', 'image_url' => 'https://example.com/agua_con_gas.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Jugos Naturales', 'description' => 'Jugos frescos de frutas', 'image_url' => 'https://example.com/jugos_naturales.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Té Helado', 'description' => 'Té frío con limón', 'image_url' => 'https://example.com/te_helado.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Limonada', 'description' => 'Jugo de limón natural', 'image_url' => 'https://example.com/limonada.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 1, 'name' => 'Cerveza', 'description' => 'Cerveza fría de marca local', 'image_url' => 'https://example.com/cerveza.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Entradas
            ['category_id' => 2, 'name' => 'Alitas de Pollo', 'description' => 'Alitas crujientes con salsa barbacoa', 'image_url' => 'https://example.com/alitas_pollo.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Chips con Guacamole', 'description' => 'Chips acompañados con guacamole fresco', 'image_url' => 'https://example.com/chips_guacamole.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Nachos con Queso', 'description' => 'Nachos cubiertos con queso derretido y salsa', 'image_url' => 'https://example.com/nachos_queso.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Bruschetta', 'description' => 'Pan tostado con tomate, ajo, albahaca y aceite de oliva', 'image_url' => 'https://example.com/bruschetta.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Ceviche', 'description' => 'Pescado marinado con limón, cebolla y cilantro', 'image_url' => 'https://example.com/ceviche.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Empanadas de Carne', 'description' => 'Empanadas rellenas de carne de res', 'image_url' => 'https://example.com/empanada_carne.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Rollitos de Primavera', 'description' => 'Rollitos fritos con carne y vegetales', 'image_url' => 'https://example.com/rollitos_primavera.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Humus con Pita', 'description' => 'Humus acompañado con pan pita', 'image_url' => 'https://example.com/humus_pita.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Tartar de Atún', 'description' => 'Atún crudo acompañado de aguacate y salsa de soja', 'image_url' => 'https://example.com/tartar_atun.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 2, 'name' => 'Sopa de Lentejas', 'description' => 'Sopa caliente de lentejas y vegetales', 'image_url' => 'https://example.com/sopa_lentejas.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Platos principales
            ['category_id' => 3, 'name' => 'Tacos de Carnitas', 'description' => 'Tacos rellenos de carne de cerdo con cebolla y cilantro', 'image_url' => 'https://example.com/tacos_carnitas.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Salmón a la Parrilla', 'description' => 'Salmón a la parrilla con salsa de limón y hierbas', 'image_url' => 'https://example.com/salmon_parrilla.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Hamburguesa Clásica', 'description' => 'Hamburguesa de carne de res con queso', 'image_url' => 'https://example.com/hamburguesa_clasica.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Pollo al Horno', 'description' => 'Pollo asado con papas y hierbas', 'image_url' => 'https://example.com/pollo_horno.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Pizza Margherita', 'description' => 'Pizza con tomate, mozzarella y albahaca', 'image_url' => 'https://example.com/pizza_margherita.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Lasaña', 'description' => 'Lasaña con carne, salsa bechamel y queso gratinado', 'image_url' => 'https://example.com/lasana.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Spaghetti Bolognesa', 'description' => 'Espaguetis con salsa de carne y tomate', 'image_url' => 'https://example.com/spaghetti_bolognesa.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Ribs BBQ', 'description' => 'Costillas de cerdo con salsa barbacoa', 'image_url' => 'https://example.com/ribs_bqq.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Sushi Variado', 'description' => 'Selección de sushi con atún, salmón y aguacate', 'image_url' => 'https://example.com/sushi_variado.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 3, 'name' => 'Curry de Pollo', 'description' => 'Pollo con arroz y salsa de curry', 'image_url' => 'https://example.com/curry_pollo.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Postres
            ['category_id' => 4, 'name' => 'Tiramisú', 'description' => 'Postre italiano con capas de café y crema mascarpone', 'image_url' => 'https://example.com/tiramisu.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Brownie con Helado', 'description' => 'Brownie de chocolate con helado de vainilla', 'image_url' => 'https://example.com/brownie_helado.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Flan de Vainilla', 'description' => 'Postre de flan con sabor a vainilla', 'image_url' => 'https://example.com/flan_vainilla.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Cheesecake', 'description' => 'Tarta de queso con base de galleta', 'image_url' => 'https://example.com/cheesecake.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Mousse de Chocolate', 'description' => 'Mousse de chocolate suave y cremoso', 'image_url' => 'https://example.com/mousse_chocolate.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Pastel de Zanahoria', 'description' => 'Pastel de zanahoria con cobertura de queso crema', 'image_url' => 'https://example.com/pastel_zanahoria.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Helado de Fruta', 'description' => 'Helado natural de frutas', 'image_url' => 'https://example.com/helado_fruta.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Panna Cotta', 'description' => 'Postre italiano de crema con frutas rojas', 'image_url' => 'https://example.com/panna_cotta.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Tarta de Limón', 'description' => 'Tarta de limón con base de galleta', 'image_url' => 'https://example.com/tarta_limon.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 4, 'name' => 'Pudín de Chía', 'description' => 'Pudín de chía con leche de almendras y frutas', 'image_url' => 'https://example.com/pudin_chia.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Ensaladas
            ['category_id' => 5, 'name' => 'Ensalada Griega', 'description' => 'Ensalada con pepino, tomate, aceitunas y queso feta', 'image_url' => 'https://example.com/ensalada_griega.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada Caprese', 'description' => 'Ensalada con tomate, mozzarella y albahaca', 'image_url' => 'https://example.com/ensalada_caprese.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada César', 'description' => 'Ensalada con pollo, croutons y aderezo César', 'image_url' => 'https://example.com/ensalada_cesar.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada de Quinoa', 'description' => 'Ensalada de quinoa con vegetales y limón', 'image_url' => 'https://example.com/ensalada_quinoa.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada de Atún', 'description' => 'Ensalada con atún, lechuga, tomate y pepino', 'image_url' => 'https://example.com/ensalada_atun.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada Mediterránea', 'description' => 'Ensalada con tomate, pepino, aceitunas, cebolla y feta', 'image_url' => 'https://example.com/ensalada_mediterranea.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada de Pollo', 'description' => 'Ensalada con pollo a la parrilla, tomate y aguacate', 'image_url' => 'https://example.com/ensalada_pollo.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada de Frutas', 'description' => 'Ensalada fresca con frutas de temporada', 'image_url' => 'https://example.com/ensalada_frutas.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada de Espinaca', 'description' => 'Ensalada con espinaca, fresas y nueces', 'image_url' => 'https://example.com/ensalada_espinaca.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_id' => 5, 'name' => 'Ensalada de Arroz Integral', 'description' => 'Ensalada con arroz integral, pimientos y cebollín', 'image_url' => 'https://example.com/ensalada_arroz_integral.jpg', 'available' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
