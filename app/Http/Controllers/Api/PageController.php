<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function index() {
        $acara = Acara::orderBy('tanggal', 'desc')->paginate(3);
        $acaraTerbaru = Acara::orderBy('tanggal', 'desc')->first();
        $kegiatan = Kegiatan::orderBy('tanggal', 'desc')->get();
        return view('index', compact('acara', 'acaraTerbaru', 'kegiatan'));
    }
}
