<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pwlController extends Controller
{
    public function tampilkanHalaman()
    {
        return view('pwl');
    }
}
