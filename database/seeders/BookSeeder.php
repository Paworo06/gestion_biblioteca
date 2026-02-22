<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['titulo' => 'Don Quijote de la Mancha',    'autor' => 'Miguel de Cervantes',  'isbn' => '9788420412146', 'descripcion' => 'La obra cumbre de la literatura española.', 'stock' => 3],
            ['titulo' => 'Cien años de soledad',         'autor' => 'Gabriel García Márquez','isbn' => '9780307474728', 'descripcion' => 'Una saga familiar en el pueblo de Macondo.', 'stock' => 2],
            ['titulo' => 'La sombra del viento',         'autor' => 'Carlos Ruiz Zafón',    'isbn' => '9788408163435', 'descripcion' => 'Un joven descubre un misterioso libro en Barcelona.', 'stock' => 4],
            ['titulo' => '1984',                         'autor' => 'George Orwell',         'isbn' => '9780451524935', 'descripcion' => 'Una distopía sobre el totalitarismo y la vigilancia.', 'stock' => 2],
            ['titulo' => 'El nombre de la rosa',         'autor' => 'Umberto Eco',           'isbn' => '9788420633367', 'descripcion' => 'Una investigación medieval llena de misterio.', 'stock' => 1],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Crea 10 libros adicionales con datos aleatorios usando el factory
        Book::factory()->count(10)->create();
    }
}
