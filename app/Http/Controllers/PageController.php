<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Event;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function index() {
        $acara = Acara::orderBy('tanggal', 'desc')->paginate(3);
        $acaraTerbaru = Acara::orderBy('tanggal', 'desc')->first();
        $kegiatan = Kegiatan::orderBy('tanggal', 'desc')->get();
        $event = Event::orderBy('created_at', 'desc')->get();
        return view('index', compact('acara', 'acaraTerbaru', 'kegiatan', 'event'));
    }
}
