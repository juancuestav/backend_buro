<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketingResource;
use App\Models\Marketing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MarketingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.ver.email_marketing')->only('index');
    }


    // Pagina Vue
    public function index()
    {
        $results = MarketingResource::collection(Marketing::all());
        return response()->json(compact('results'));
    }
}
