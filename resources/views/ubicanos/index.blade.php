@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <h1 class="fs-5 mb-0 text-dark fw-bold mb-4"><i class="bi-geo-alt me-2"></i>Ubícanos</h1>
            Encuéntranos en la siguiente dirección.
        </div>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d498.3641002261509!2d-79.893928!3d-2.1867506!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x902d6d1002c513c1%3A0x1f6ca88f4cbfbe00!2sEdificio%20Orellana!5e0!3m2!1ses!2sec!4v1655242044316!5m2!1ses!2sec"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

        {{-- <div class="text-center py-4">
            <img src="{{ asset('img/ubicanos.jpeg') }}" alt="Imagen de ubicación de Buro Ecuador" class="w-50">
        </div> --}}
    </div>
@endsection
