<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function indexEvent()
    {
        if (auth()->user()->role == 'admin') {
            $events = Event::get();
        }
        return view('admin.event.index', compact('events'));
    }

    public function createEvent()
    {
        return view('admin.event.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('event_images', 'public');
        }

        Event::create([
            'id_isc' => auth()->user()->id_isc,
            'judul' => $request->judul,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'harga' => $request->harga,
            'image_path' => $path,
        ]);

        return back()->with('success', 'Event berhasil dibuat.');
    }

    public function destroyEvent($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar kalau ada
        if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
            Storage::disk('public')->delete($event->image_path);
        }

        $event->delete();

        return back()->with('success', 'Event berhasil dihapus.');
    }
}
