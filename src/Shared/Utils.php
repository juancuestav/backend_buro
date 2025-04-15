<?php

namespace Src\Shared;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class Utils
{
    public static function esBase64(string $imagen): bool
    {
        return str_contains($imagen, ';base64');
    }

    public static function decodificarImagen(string $imagen_base64): string
    {
        $partes = explode(";base64,", $imagen_base64);
        return base64_decode($partes[1]);
    }

    public static function obtenerMimeType(string $imagen_base64): string
    {
        return explode("/", mime_content_type($imagen_base64))[1];
    }

    public static function obtenerExtension(string $imagen_base64): string
    {
        $mime_type = self::obtenerMimeType($imagen_base64);
        return explode("+", $mime_type)[0];
    }

    public static function arrayToCsv(string $campos, array $listado): string
    {
        $ruta_archivo_temporal = '../storage/app/plantilla.csv';
        $archivo_csv = fopen($ruta_archivo_temporal, 'w'); // default public
        fputs($archivo_csv, $campos . PHP_EOL);

        foreach ($listado as $fila) {
            fputs($archivo_csv, implode(',', $fila) . PHP_EOL);
        }
        fclose($archivo_csv);
        return $ruta_archivo_temporal;
    }

    public static function generarNombreArchivoAleatorio(string $extension): string
    {
        $nombre = Str::random(10);
        return $nombre . '.' . $extension;
    }

    public static function obtenerRutaAbsolutaImagen(string $ruta_imagen_en_public, string $nombre_archivo): string
    {
        return storage_path() . '/app/' . $ruta_imagen_en_public . $nombre_archivo;
    }

    public static function obtenerRutaRelativaImagen(string $ruta, string $nombre_archivo = ""): string
    {
        $ruta = str_replace('public/', '', $ruta);
        return '/storage/' . $ruta . $nombre_archivo;
    }

    public static function obtenerMensaje(string $entidad, string $metodo, string $genero = 'M')
    {
        $mensajes = [
            'store' => $entidad . ' guardad' . ($genero == 'M' ? 'o' : 'a') . ' exitosamente!',
            'update' => $entidad . ' actualizad' . ($genero == 'M' ? 'o' : 'a') . ' exitosamente!',
            'destroy' => $entidad . ' eliminad' . ($genero == 'M' ? 'o' : 'a') . ' exitosamente!',
        ];

        return $mensajes[$metodo];
    }

    public static function obtenerRutaRelativaArchivo(string $ruta): string
    {
        $ruta = str_replace('public/', '', $ruta);
        return '/storage/' . $ruta;
    }

    /**
     * La función `obtenerMensajeErrorLanzable` devuelve una ValidationException con un mensaje de
     * error personalizado basado en la excepción o Throwable proporcionado.
     *
     * @param Exception|Throwable $e El parámetro `e` es objeto de una instancia de la clase `Exception` o interfaz `Throwable`.
     * @param string $textoPersonalizado El parámetro `textoPersonalizado` es una cadena que le permite
     * proporcionar un mensaje personalizado o información adicional que se puede agregar al mensaje de
     * error. Es opcional y se puede utilizar para personalizar aún más el mensaje de error según
     * requisitos o contexto específicos.
     *
     * @return ValidationException Se devuelve una `ValidationException` con un mensaje que contiene un error obtenido del
     * método `obtenerMensajeError`, que toma un objeto `Exception` o `Throwable` y un texto
     * personalizado como parámetros.
     */
    public static function obtenerMensajeErrorLanzable(Exception|Throwable $e, string $textoPersonalizado = '')
    {
        return ValidationException::withMessages(['error' => self::obtenerMensajeError($e, $textoPersonalizado)]);
    }


    /**
     * La función "obtenerMensajeError" en PHP devuelve un mensaje de error formateado que incluye el
     * número de línea, el texto personalizado y el mensaje de excepción.
     *
     * @param Exception|Throwable $e El parámetro `e` es un objeto de tipo `Exception`. La función recupera
     * información de este objeto de excepción, como el mensaje y número de línea donde ocurrió la excepción.
     * @param string $textoPersonalizado Le permite
     * proporcionar un mensaje personalizado o información adicional para incluir en el mensaje de
     * error.
     *
     * @return string mensaje de error formateado que incluye el número de línea donde ocurrió la
     * excepción, cualquier texto personalizado proporcionado y el mensaje de excepción en sí.
     */
    public static function obtenerMensajeError(Exception|Throwable $e, string $textoPersonalizado = '')
    {
        return '[ERROR][' . $e->getLine() . ']: ' . $textoPersonalizado . ' .' . $e->getMessage();
    }
}
