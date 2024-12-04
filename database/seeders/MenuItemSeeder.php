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
            [
                'category_id' => 1,
                'name' => 'Tamalitos verdes',
                'description' => 'Tamalitos a base de maíz verde, típicos de la región norteña',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Ceviche mixto',
                'description' => 'Ceviche de pescados frescos y mixtos con mariscos, un clásico de la costa',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Tiradito de pescado',
                'description' => 'Delgados filetes de pescado en salsa de limón y ají, estilo peruano',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Ceviche de Pescado',
                'description' => 'Ceviche de pescados frescos, un clásico de la costa',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Ceviche Ojo de Uva',
                'description' => 'Ceviche de pescados Ojo de Uva, un clásico de la costa',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Tortilla de Raya',
                'description' => 'Tortilla de maiz y de pescado Raya',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Ceviche Mero',
                'description' => 'Ceviche de pescados Mero, un clásico de la costa',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 1,
                'name' => 'Humitas',
                'description' => 'Humitas de maiz con salsa de limón y ají, estilo peruano',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 2,
                'name' => 'Ceviche Maternal',
                'description' => 'Ceviche tradicional con ingredientes frescos y un toque casero',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche de caballa',
                'description' => 'Ceviche preparado con caballa fresca, marinado en limón y especias',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche Exótico en el Rincón',
                'description' => 'Ceviche con sabores tropicales y mariscos frescos, servido en un rincón especial',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche de Pescado y/o tiradito',
                'description' => 'Ceviche de pescado fresco, opción de tiradito con salsas de ají',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche Mixto',
                'description' => 'Ceviche mixto de mariscos frescos, marinado en jugo de limón y especias',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche de Ojo de Uva',
                'description' => 'Ceviche único con pescado fresco y jugo de uva para un toque especial',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche de Robalo',
                'description' => 'Ceviche preparado con robalo fresco, marinado en limón y ají',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche Mixto de Ojo de Uva',
                'description' => 'Ceviche mixto con jugo de uva y una variedad de mariscos frescos',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche Mixto de Robalo',
                'description' => 'Ceviche mixto preparado con robalo y otros mariscos, marinado al estilo tradicional',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche de Pulpo',
                'description' => 'Ceviche de pulpo fresco, marinado con jugo de limón y un toque de ají',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ceviche de Langostinos',
                'description' => 'Ceviche preparado con langostinos frescos, marinado en limón y hierbas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Causa de Pescado y otros',
                'description' => 'Causa rellena de pescado fresco y otros ingredientes peruanos',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Leche de Tigre',
                'description' => 'Leche de tigre fresca y picante, servida como un energizante plato',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 2,
                'name' => 'Ocopa de Langostinos',
                'description' => 'Ocopa cremosa servida con langostinos frescos y papas andinas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 3,
                'name' => 'Jalea de Pescado',
                'description' => 'Jalea crujiente de pescado fresco, acompañada de yuca frita y salsa criolla',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 3,
                'name' => 'Jalea Mixta',
                'description' => 'Jalea mixta con una combinación de mariscos y pescado, servida con yuca frita y salsas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 3,
                'name' => 'Jalea de Ojo de Uva',
                'description' => 'Jalea especial preparada con pescado de ojo de uva, acompañada de yuca frita y salsas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 3,
                'name' => 'Jalea de Robalo',
                'description' => 'Jalea de robalo fresco, crujiente y servida con yuca frita y salsa criolla',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 3,
                'name' => 'Jalea de Mero o Lenguado',
                'description' => 'Jalea crujiente de mero o lenguado, servida con yuca frita y salsa criolla',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 4,
                'name' => 'Chicharrón de Pescado con yuca frita',
                'description' => 'Chicharrón crujiente de pescado fresco, acompañado de yuca frita y salsa criolla',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 4,
                'name' => 'Chicharrón de Ojo de Uva con yuca frita',
                'description' => 'Chicharrón crujiente de pescado de ojo de uva, servido con yuca frita',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 4,
                'name' => 'Chicharrón de Langostinos con yuca frita',
                'description' => 'Chicharrón crujiente de langostinos frescos, acompañado de yuca frita',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 4,
                'name' => 'Chicharrón de Robalo',
                'description' => 'Chicharrón crujiente de robalo, servido con yuca frita y salsas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Sudado de Conchas Negras',
                'description' => 'Sudado de conchas negras frescas, cocinado con hierbas y especias',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Ceviche o Tortilla de Conchas Negras',
                'description' => 'Ceviche tradicional o tortilla de conchas negras, preparado con limón y ají',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Ceviche de Pescado con Conchas Negras',
                'description' => 'Ceviche de pescado fresco combinado con conchas negras, servido con camote y choclo',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Ceviche de Ojo de Uva con Conchas Negras',
                'description' => 'Ceviche de pescado ojo de uva con conchas negras, en limón fresco y especias',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Ceviche de Robalo con Conchas Negras',
                'description' => 'Ceviche de robalo fresco con conchas negras, acompañado de maíz y batata',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Ceviche de Lenguado o Mero con Conchas Negras',
                'description' => 'Ceviche de lenguado o mero con conchas negras, marinado en limón y ají',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Arroz con Mariscos y Conchas Negras',
                'description' => 'Arroz sazonado con mariscos frescos y conchas negras, un festín de sabores marinos',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 5,
                'name' => 'Arroz con Conchas Negras',
                'description' => 'Arroz preparado con conchas negras, cocido a la perfección con especias',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 6,
                'name' => 'Tortilla de Yuyo',
                'description' => 'Tortilla hecha con yuyo fresco y especias, un plato tradicional del mar',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 6,
                'name' => 'Tortilla de Raya',
                'description' => 'Tortilla suave y deliciosa hecha con raya, sazonada y cocida al punto',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 6,
                'name' => 'Tortilla de Mariscos',
                'description' => 'Tortilla de mariscos mixtos, servida con salsas frescas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 6,
                'name' => 'Omelet de Mariscos',
                'description' => 'Omelet relleno de mariscos frescos, sazonado con hierbas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 6,
                'name' => 'Tortilla de Langostinos',
                'description' => 'Tortilla crujiente de langostinos, perfecta como entrada o plato principal',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 6,
                'name' => 'Tortilla de Huevos',
                'description' => 'Tortilla clásica de huevos, sencilla y esponjosa',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 7,
                'name' => 'Arroz con pato',
                'description' => 'Arroz sazonado con culantro y servido con pato tierno',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 7,
                'name' => 'Pato a la Naranja',
                'description' => 'Pato cocido con una exquisita salsa de naranja',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 7,
                'name' => 'Tacu Tacu con Seco de Pato',
                'description' => 'Tacu tacu de arroz y frejoles, servido con un jugoso seco de pato',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 7,
                'name' => 'Cabrito Combinado',
                'description' => 'Cabrito norteño acompañado de arroz, frijoles y yuca',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 7,
                'name' => 'Cabrito Deshuesado',
                'description' => 'Cabrito deshuesado, cocido a fuego lento con especias y hierbas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 7,
                'name' => 'Bisteck con arroz',
                'description' => 'Bisteck a la parrilla, acompañado de arroz blanco y ensalada',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],
            [
                'category_id' => 7,
                'name' => 'Bisteck a lo pobre',
                'description' => 'Bisteck a la parrilla servido con arroz, plátano frito, huevo y papas fritas',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 7,
                'name' => 'Lomo Fino',
                'description' => 'Lomo fino de res, cocido al gusto y servido con guarniciones a elección',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 8,
                'name' => 'Sopa a la criolla',
                'description' => 'Sopa a base de carne, fideos y especias, tradicional y sabrosa',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 8,
                'name' => 'Sopa a la minuta',
                'description' => 'Sopa ligera de carne y fideos con un toque de leche, muy reconfortante',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 8,
                'name' => 'Sopa de Fideo fino',
                'description' => 'Sopa de fideo fino con un caldo suave y delicioso',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 9,
                'name' => 'Chicha Morada',
                'description' => 'Refresco tradicional de maíz morado, aromatizado con frutas y especias',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 9,
                'name' => 'Limonada',
                'description' => 'Limonada fresca y natural, perfecta para acompañar los platos',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Gaseosa Personal',
                'description' => 'Gaseosa individual para refrescar tu comida',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Gaseosa Litro',
                'description' => 'Botella de gaseosa de un litro, ideal para compartir',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Cusqueña (Blanca/Negra) 620ml',
                'description' => 'Cerveza Cusqueña en presentación de 620ml, disponible en variedades blanca o negra',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Cusqueña Personal',
                'description' => 'Cerveza Cusqueña en botella personal, perfecta para disfrutar sola',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Pilsen 620ml',
                'description' => 'Cerveza Pilsen en botella de 620ml, refrescante y lista para compartir',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Pilsen Personal',
                'description' => 'Cerveza Pilsen en botella personal, perfecta para disfrutar sola',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Cristal 620ml',
                'description' => 'Cerveza Cristal en botella de 620ml, refrescante y lista para compartir',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Cristal Personal',
                'description' => 'Cerveza Cristal en botella personal, perfecta para disfrutar sola',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Corona 620ml',
                'description' => 'Cerveza Corona en botella de 620ml, refrescante y lista para compartir',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ],

            [
                'category_id' => 10,
                'name' => 'Cerveza Corona Personal',
                'description' => 'Cerveza Corona en botella personal, perfecta para disfrutar sola',
                'image_url' => '',
                'available' => true,
                'created_at' => '2024-01-10 12:30:00',
                'updated_at' => '2024-02-15 14:20:00'
            ]
        ]);
    }
}
