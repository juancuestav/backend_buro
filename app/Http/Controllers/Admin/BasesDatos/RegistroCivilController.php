<?php

namespace App\Http\Controllers\Admin\BasesDatos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\RegistroCivilResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use SplFileObject;
use Src\App\Sistema\PaginationService;

class RegistroCivilController extends Controller
{
    protected PaginationService $paginationService;

    public function __construct()
    {
        $this->paginationService = new PaginationService();
    }

    public function index()
    {
        $results = DB::connection('sqlite_registro_civil')
            ->table('registro_civil')
            ->where('cedula', request('search'))
            ->get();

        return RegistroCivilResource::collection($results);
    }

    // $results ? response()->json($results) : response()->json(['error' => 'No encontrado'], 404);

    private function crearArchivoSQLite()
    {
        $databasePath = storage_path('database/registro_civil.db');

        if (!File::exists(dirname($databasePath))) {
            File::makeDirectory(dirname($databasePath), 0755, true, true);
        }

        if (!File::exists($databasePath)) {
            file_put_contents($databasePath, '');
            Log::info("Base de datos SQLite creada en: $databasePath");
        }
    }

    public function crearBaseDatosSqliteOld()
    {
        $this->crearArchivoSQLite();
        $databasePath = storage_path('database/registro_civil.db');

        Log::info('Creando base de datos SQLite', ['Ruta' => $databasePath]);

        DB::connection('sqlite_buro')->statement("
            CREATE TABLE IF NOT EXISTS personas (
                cedula TEXT PRIMARY KEY,
                apellidos_nombres TEXT,
                sexo_id INTEGER,
                condicion_id INTEGER,
                fecha_nacimiento TEXT,
                pais_id INTEGER,
                estado_civil_id INTEGER,
                conyugue TEXT,
                cedula_conyugue TEXT,
                apellidos_nombres_padre TEXT,
                pais_padre_id INTEGER,
                cedula_padre TEXT,
                apellidos_nombres_madre TEXT,
                pais_madre_id INTEGER,
                cedula_madre TEXT,
                direccion TEXT,
                fecha_matrimonio TEXT,
                instruccion_id INTEGER,
                puesto_ocupacion_id INTEGER,
                fecha_emision TEXT,
                codigo_dactilar TEXT
            )
        ");

        $filePath = storage_path('app/personas.csv');

        if (!File::exists($filePath)) {
            return response()->json(['error' => 'El archivo CSV no existe'], 400);
        }

        $file = fopen($filePath, 'r');

        if (!$file) {
            return response()->json(['error' => 'No se pudo abrir el archivo CSV'], 500);
        }

        fgetcsv($file); // Leer y omitir encabezados

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) < 21) continue; // Evitar registros incompletos

            DB::connection('sqlite_buro')->table('personas')->insert([
                'cedula' => $row[0],
                'apellidos_nombres' => $row[1],
                'sexo_id' => $row[2],
                'condicion_id' => $row[3],
                'fecha_nacimiento' => $row[4],
                'pais_id' => $row[5],
                'estado_civil_id' => $row[6],
                'conyugue' => $row[7],
                'cedula_conyugue' => $row[8],
                'apellidos_nombres_padre' => $row[9],
                'pais_padre_id' => $row[10],
                'cedula_padre' => $row[11],
                'apellidos_nombres_madre' => $row[12],
                'pais_madre_id' => $row[13],
                'cedula_madre' => $row[14],
                'direccion' => $row[15],
                'fecha_matrimonio' => $row[16],
                'instruccion_id' => $row[17],
                'puesto_ocupacion_id' => $row[18],
                'fecha_emision' => $row[19],
                'codigo_dactilar' => $row[20],
            ]);
        }

        fclose($file);

        DB::connection('sqlite_buro')->statement("CREATE INDEX IF NOT EXISTS idx_cedula ON personas (cedula)");

        return response()->json(['success' => 'Base de datos SQLite creada y datos insertados correctamente.']);
    }

    public function crearBaseDatosSqlite()
    {
        $this->crearArchivoSQLite();
        $databasePath = storage_path('registro_civil.db');

        Log::channel('testing')->info('Log', ['Ruta: ', $databasePath]);
        DB::connection('sqlite_buro')->statement("ATTACH DATABASE '$databasePath' AS registro_civil");

        // Crear la tabla si no existe
        DB::connection('sqlite_buro')->statement("
        CREATE TABLE IF NOT EXISTS personas (
            cedula TEXT PRIMARY KEY,
            apellidos_nombres TEXT,
            sexo_id INTEGER,
            condicion_id INTEGER,
            fecha_nacimiento TEXT,
            pais_id INTEGER,
            estado_civil_id INTEGER,
            conyugue TEXT,
            cedula_conyugue TEXT,
            apellidos_nombres_padre TEXT,
            pais_padre_id INTEGER,
            cedula_padre TEXT,
            apellidos_nombres_madre TEXT,
            pais_madre_id INTEGER,
            cedula_madre TEXT,
            direccion TEXT,
            fecha_matrimonio TEXT,
            instruccion_id INTEGER,
            puesto_ocupacion_id INTEGER,
            fecha_emision TEXT,
            codigo_dactilar TEXT
        )
    ");

        // Desactivar claves foráneas y mejorar el rendimiento
        DB::connection('sqlite_buro')->statement("PRAGMA synchronous = OFF");
        DB::connection('sqlite_buro')->statement("PRAGMA journal_mode = MEMORY");
        DB::connection('sqlite_buro')->statement("PRAGMA foreign_keys = OFF");

        // Configurar procesamiento eficiente del CSV
        $filePath = storage_path('app/personas.csv');
        $file = new SplFileObject($filePath);
        $file->setFlags(SplFileObject::READ_CSV);

        $batchSize = 10000; // Lote grande para mayor velocidad
        $dataBatch = [];
        $columns = [
            'cedula',
            'apellidos_nombres',
            'sexo_id',
            'condicion_id',
            'fecha_nacimiento',
            'pais_id',
            'estado_civil_id',
            'conyugue',
            'cedula_conyugue',
            'apellidos_nombres_padre',
            'pais_padre_id',
            'cedula_padre',
            'apellidos_nombres_madre',
            'pais_madre_id',
            'cedula_madre',
            'direccion',
            'fecha_matrimonio',
            'instruccion_id',
            'puesto_ocupacion_id',
            'fecha_emision',
            'codigo_dactilar'
        ];

        DB::connection('sqlite_buro')->beginTransaction();

        // Omitir el encabezado del CSV
        $file->fgetcsv();

        while (!$file->eof()) {
            $row = $file->fgetcsv();
            if (!isset($row[0]) || empty($row[0])) continue; // Ignorar líneas vacías

            $dataBatch[] = "('" . implode("', '", array_map('addslashes', $row)) . "')";

            if (count($dataBatch) >= $batchSize) {
                $this->insertBatch($dataBatch, $columns);
                $dataBatch = [];
            }
        }

        // Insertar los registros restantes
        if (!empty($dataBatch)) {
            $this->insertBatch($dataBatch, $columns);
        }

        DB::connection('sqlite_buro')->commit();

        // Reactivar claves foráneas
        DB::connection('sqlite_buro')->statement("PRAGMA foreign_keys = ON");

        // Crear índice para mejorar las búsquedas
        DB::connection('sqlite_buro')->statement("CREATE INDEX IF NOT EXISTS idx_cedula ON personas (cedula)");
    }

    private function insertBatch(array $dataBatch, array $columns)
    {
        if (empty($dataBatch)) {
            return;
        }

        $placeholders = [];
        $bindings = [];

        foreach ($dataBatch as $row) {
            if (!is_array($row) || count($row) !== count($columns)) {
                continue; // Ignorar filas inválidas
            }

            $placeholders[] = '(' . implode(',', array_fill(0, count($row), '?')) . ')';
            $bindings = array_merge($bindings, array_values($row));
        }

        if (!empty($placeholders)) {
            $query = "INSERT INTO personas (" . implode(', ', $columns) . ") VALUES " . implode(", ", $placeholders);
            DB::connection('sqlite_buro')->statement($query, $bindings);
        }
    }


    private function insertBatchOld2(array $dataBatch, array $columns)
    {
        $placeholders = [];
        $bindings = [];

        foreach ($dataBatch as $row) {
            $placeholders[] = '(' . implode(',', array_fill(0, count($row), '?')) . ')';
            $bindings = array_merge($bindings, $row);
        }

        $query = "INSERT INTO personas (" . implode(', ', $columns) . ") VALUES " . implode(", ", $placeholders);
        DB::connection('sqlite_buro')->statement($query, $bindings);
    }


    /**
     * Inserta los registros en SQLite usando SQL crudo para mayor eficiencia.
     */
    private function insertBatchOld(array $dataBatch, array $columns)
    {
        $query = "INSERT INTO personas (" . implode(', ', $columns) . ") VALUES " . implode(", ", $dataBatch);
        DB::connection('sqlite_buro')->statement($query);
    }
}
