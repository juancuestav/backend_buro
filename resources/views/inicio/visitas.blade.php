{{-- Contador --}}
<h3 class="mb-4 text-center">Visitas</h3>
<div class="py-2 contador">
    <div class="color_fondo" id="fondo_color"></div>
    <div class="numero" id="numero"></div>
</div>

@php
    function contador()
    {
        $archivo = 'contador.txt';
        $f = fopen($archivo, 'r');
        $contador = 0;
        if ($f) {
            $contador = fread($f, filesize($archivo));
            $contador = $contador + 1;
            fclose($f);
        }

        $f = fopen($archivo, 'w+');
        if ($f) {
            fwrite($f, $contador);
            fclose($f);
        }
        return $contador;
    }

    $visitante = contador();
    echo '<input id="contador" type="hidden" value="' . $visitante . '"></input>';
@endphp
