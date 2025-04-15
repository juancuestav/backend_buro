<?php

namespace App\Http\Controllers\Admin\BasesDatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IessController extends Controller
{
    public function index()
    {
        $results = DB::connection('sqlite_iess')
            ->table('iess')
            ->where('identificacion', request('search'))
            ->get();

        return response()->json(compact('results'));
    }
}
