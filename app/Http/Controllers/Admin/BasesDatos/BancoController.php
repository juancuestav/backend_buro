<?php

namespace App\Http\Controllers\Admin\BasesDatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BancoController extends Controller
{
    public function index()
    {
        $results = DB::connection('sqlite_banco')
            ->table('banco')
            ->where('cedula_ruc', request('search'))
            ->get();

        return response()->json(compact('results'));
    }
}
