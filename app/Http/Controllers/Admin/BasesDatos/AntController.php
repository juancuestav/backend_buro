<?php

namespace App\Http\Controllers\Admin\BasesDatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntController extends Controller
{
    public function index()
    {
        if (request('cedula')) {
            $results = DB::connection('sqlite_ant')
            ->table('ant')
            ->where('identificacion', request('cedula'))
            ->get();
        }

        if (request('placa')) {
            $results = DB::connection('sqlite_ant')
            ->table('ant')
            ->where('placa', request('placa'))
            ->get();
        }

        return response()->json(compact('results'));
    }
}
