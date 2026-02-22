<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    // Muestra el listado de libros disponibles para el alumno
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Muestra el detalle de un libro
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
