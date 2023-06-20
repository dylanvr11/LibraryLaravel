{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hola mundo</h1>
</div>
@endsection --}}

{{-- Nueva sintaxis --}}

{{--
    si le quiero pasar el titulo desde acá
    <x-app title="Hola mundo">
    sin titulo
    <x-app>
    <x-app title="Biblioteca cental" :sum="2+3">
--}}
<x-app title="Biblioteca cental">
    {{-- A Book --}}
    <section class="d-flex justify-content-center flex-wrap">
        @foreach ($books as $book)
            <div class="card mx-3 my-3" style="width: 18rem;">
                @if($book->image)
                    <img src="/storage/images/{{$book->image}}"         class="card-img-top" alt="Libro">
                @else
                    <img src="https://edit.org/photos/img/blog/ppe-crear-portadas-de-libros-online.jpg-840.jpg"         class="card-img-top" alt="Libro">
                @endif
                <div class="card-body">
                  <h5 class="card-title">{{$book->title}}</h5>
                  <p class="card-text">{{$book->description}}</p>
                  <a href="#" class="btn btn-primary">Prestar</a>
                </div>
            </div>
        @endforeach
    </section>
</x-app>

