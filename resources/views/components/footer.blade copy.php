<footer class="bg-morado text-center text-white pt-5">
    <section class="mb-4">
        <!-- Facebook -->
        @if (Config::get('buro.facebook'))
            <a class="btn text-white m-1" href="{{ Config::get('buro.facebook') }}" role="button" target="_blank"><i
                    class="bi-facebook fs-4"></i></a>
        @endif

        <!-- Instagram -->
        @if (Config::get('buro.instagram'))
            <a class="btn text-white m-1" href="{{ Config::get('buro.instagram') }}" role="button" target="_blank"><i
                    class="bi-instagram fs-4"></i></a>
        @endif

        <!-- Twitter -->
        @if (Config::get('buro.twitter'))
            <a class="btn text-white m-1" href="{{ Config::get('buro.twitter') }}" role="button" target="_blank"><i
                    class="bi-twitter fs-4"></i></a>
        @endif
    </section>

    <section class="row mb-4 px-3 g-0">
        <div class="col-12">
            <p><b>Matriz: </b> Edificio Orellana Piso 3 oficina 5, Los Rios 609 & Quisquis, Guayaquil</p>
            <p><b>Email:</b> atencionclientes@burodecredito.ec</p>
        </div>
    </section>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0,0,0, 0.2);">
        © 2025 Copyright
        <a class="text-white" href="{{ route('inicio') }}">Buró de Crédito Ecuador</a>
    </div>
</footer>
