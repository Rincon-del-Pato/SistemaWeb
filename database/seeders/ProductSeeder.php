<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            // Entradas (category_id = 1)
            [
                'name' => 'Tamalitos verdes',
                'price' => 4.00,
                'description' => 'Tamalitos a base de maíz verde, típicos de la región norteña.',
                'status' => 'Oculto',
                'image_producto' => 'products/Fj1Oz879eweK3EDbX5o0VcI10e8HMZ6RdLq7lXzm.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Ceviche mixto',
                'price' => 20.00,
                'description' => 'Ceviche de pescados frescos y mixtos con mariscos, un clásico de la costa.',
                'status' => 'Oculto',
                'image_producto' => 'products/HCX8oDI7WZUpNFoFvlFtngxbOxnD6DFhJaLTLkdE.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Tiradito de pescado',
                'price' => 20.00,
                'description' => 'Delgados filetes de pescado en salsa de limón y ají, estilo peruano.',
                'status' => 'Oculto',
                'image_producto' => 'products/134JjJw1ErdX1aZsHyoFy1V742R1S85ltW89DkFm.jpg',
                'category_id' => 1,
            ],
            // Pescados y Mariscos (category_id = 2)
            [
                'name' => 'Sudado de cabrilla',
                'price' => 25.00, // Precio temporal
                'description' => 'Sudado de cabrilla fresca, preparado con especias y hierbas.',
                'status' => 'Oculto',
                'image_producto' => 'products/lGXSe5kaTZJRB4rwW9Ez7UrwpOszp1USut9lLS99.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Sudado de mero',
                'price' => 30.00, // Precio temporal
                'description' => 'Delicioso sudado de mero, cocido a fuego lento con aderezos peruanos.',
                'status' => 'Oculto',
                'image_producto' => 'products/fdjTy89ymZA6cEK9cIcBAnabTJgK1GjwPJljYGii.jpg',
                'category_id' => 2,
            ],
            // Jaleas (category_id = 3)
            [
                'name' => 'Jalea de Pescado',
                'price' => 18.00, // Precio temporal
                'description' => 'Jalea crujiente de pescado de la temporada, acompañada de salsa criolla.',
                'status' => 'Oculto',
                'image_producto' => 'products/bReDDupcc8XMSeGkAnwcmhgNiYG7zdkbiB0dO3wR.jpg',
                'category_id' => 3,
            ],
            // Chicharrones (category_id = 4)
            [
                'name' => 'Chicharrón de pescado',
                'price' => 20.00,
                'description' => 'Chicharrón crujiente de pescado fresco, frito al punto.',
                'status' => 'Oculto',
                'image_producto' => 'products/2VuwNd8ocmzhr6ua54cToiHuf0W44RZYnLLkDPt6.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Chicharrón de langostino',
                'price' => 25.00,
                'description' => 'Chicharrón de langostino frito, crocante y delicioso.',
                'status' => 'Oculto',
                'image_producto' => 'products/rJzFobXX9bfGSRYKmLFJd1H0YzDXdAoCo99QEXnK.jpg',
                'category_id' => 4,
            ],
            // Platos de la casa (category_id = 5)
            [
                'name' => 'Arroz con Pato',
                'price' => 22.00,
                'description' => 'Tradicional arroz con pato a la chiclayana, sazonado con culantro.',
                'status' => 'Oculto',
                'image_producto' => 'products/dL9X9nENJS2EhsHKy7eJriz1iFS9xqglEmxw1ZGT.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Pato estofado',
                'price' => 22.00,
                'description' => 'Pato estofado con arvejas y especias, típico del norte peruano.',
                'status' => 'Oculto',
                'image_producto' => 'products/pm9IqeCbEEKEK5I7iOmMbiaMtGltk2cjrVQCzYOe.jpg',
                'category_id' => 5,
            ],
            // Tacu tacu (category_id = 6)
            [
                'name' => 'Tacu tacu con lomo saltado',
                'price' => 26.00,
                'description' => 'Clásico tacu tacu de arroz y frejoles con lomo saltado, plato fusión.',
                'status' => 'Oculto',
                'image_producto' => '',
                'category_id' => 6,
            ],
            [
                'name' => 'Tacu tacu con Pescado a lo Macho',
                'price' => 22.00,
                'description' => 'Tacu tacu acompañado de pescado y salsa de mariscos picante.',
                'status' => 'Oculto',
                'image_producto' => '',
                'category_id' => 6,
            ],
            // Sopas (category_id = 7)
            [
                'name' => 'Sopa a la minuta',
                'price' => 10.00,
                'description' => 'Sopa ligera de carne y fideos con un toque de leche.',
                'status' => 'Oculto',
                'image_producto' => '',
                'category_id' => 7,
            ],
            [
                'name' => 'Dieta',
                'price' => 10.00,
                'description' => 'Caldo nutritivo de carne o pollo, ideal para recuperar fuerzas.',
                'status' => 'Oculto',
                'image_producto' => '',
                'category_id' => 7,
            ],
            // Refrescos (category_id = 8)
            [
                'name' => 'Maracuyá',
                'price' => 10.00,
                'description' => 'Refresco natural de maracuyá, refrescante y delicioso.',
                'status' => 'Oculto',
                'image_producto' => '',
                'category_id' => 8,
            ],
            [
                'name' => 'Limonada',
                'price' => 10.00,
                'description' => 'Limonada fresca y natural para acompañar los platos.',
                'status' => 'Oculto',
                'image_producto' => '',
                'category_id' => 8,
            ],
        ]);
    }
}
