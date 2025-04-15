<?php

namespace App\Http\Controllers\Admin\BasesDatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SriController extends Controller
{
    public function index()
    {
        $ruc = request('search') . '001';
        $results = DB::connection('sqlite_sri')
            ->table('sri')
            ->where('numero_ruc', request('search'))
            ->get();
            //->orWhere('numero_ruc', $ruc)

        return response()->json(compact('results'));
    }
}
