<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONTEND
    |--------------------------------------------------------------------------
    */

    public function indexFrontend()
    {
        $events = Event::latest('tanggal')->get();

        return view('frontend.event', compact('events'));
    }


    public function showFrontend(Event $event)
    {
        return view('frontend.event-detail', compact('event'));
    }


    /*
    |--------------------------------------------------------------------------
    | BACKEND
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $events = Event::latest('tanggal')->get();

        return view('backend.v_event.index', compact('events'));
    }


    public function create()
    {
        return view('backend.v_event.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([

            'judul' => 'required|string|max:255',

            'deskripsi' => 'nullable|string',

            'tanggal' => 'required|date',

            'waktu' => 'nullable',

            'lokasi' => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | PENDAFTARAN
            |--------------------------------------------------------------------------
            */

            'pendaftaran_aktif' => 'nullable|boolean',

            /*
            |--------------------------------------------------------------------------
            | FOTO
            |--------------------------------------------------------------------------
            */

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            /*
            |--------------------------------------------------------------------------
            | MATERI
            |--------------------------------------------------------------------------
            */

            'materi' => [
                'nullable',
                'file',
                'mimes:pdf,ppt,pptx',
                'max:10240'
            ],

            /*
            |--------------------------------------------------------------------------
            | GALERI
            |--------------------------------------------------------------------------
            */

            'galeri.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PENDAFTARAN AKTIF
        |--------------------------------------------------------------------------
        |
        | Checkbox dicentang = true
        | Checkbox tidak dicentang = false
        |
        */

        $data['pendaftaran_aktif'] =
            $request->has('pendaftaran_aktif');


        /*
        |--------------------------------------------------------------------------
        | STATUS OTOMATIS
        |--------------------------------------------------------------------------
        */

        $data['status'] = Carbon::parse($data['tanggal'])
            ->lt(Carbon::today())
            ? 'selesai'
            : 'akan_datang';


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('event', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD MATERI
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('materi')) {

            $data['materi'] = $request
                ->file('materi')
                ->store('event/materi', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD GALERI
        |--------------------------------------------------------------------------
        */

        $galeri = [];

        if ($request->hasFile('galeri')) {

            foreach ($request->file('galeri') as $foto) {

                $galeri[] = $foto->store(
                    'event/galeri',
                    'public'
                );
            }
        }


        $data['galeri'] = !empty($galeri)
            ? $galeri
            : null;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN EVENT
        |--------------------------------------------------------------------------
        */

        Event::create($data);


        return redirect()
            ->route('admin.event.index')
            ->with(
                'success',
                'Event berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Event $event)
    {
        return view(
            'backend.v_event.edit',
            compact('event')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([

            'judul' => 'required|string|max:255',

            'deskripsi' => 'nullable|string',

            'tanggal' => 'required|date',

            'waktu' => 'nullable',

            'lokasi' => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | PENDAFTARAN
            |--------------------------------------------------------------------------
            */

            'pendaftaran_aktif' => 'nullable|boolean',

            /*
            |--------------------------------------------------------------------------
            | FOTO
            |--------------------------------------------------------------------------
            */

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            /*
            |--------------------------------------------------------------------------
            | MATERI
            |--------------------------------------------------------------------------
            */

            'materi' => [
                'nullable',
                'file',
                'mimes:pdf,ppt,pptx',
                'max:10240'
            ],

            /*
            |--------------------------------------------------------------------------
            | GALERI
            |--------------------------------------------------------------------------
            */

            'galeri.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PENDAFTARAN AKTIF
        |--------------------------------------------------------------------------
        |
        | Wajib menggunakan has() karena checkbox
        | tidak mengirim value ketika tidak dicentang.
        |
        */

        $data['pendaftaran_aktif'] =
            $request->has('pendaftaran_aktif');


        /*
        |--------------------------------------------------------------------------
        | STATUS OTOMATIS
        |--------------------------------------------------------------------------
        */

        $data['status'] = Carbon::parse($data['tanggal'])
            ->lt(Carbon::today())
            ? 'selesai'
            : 'akan_datang';


        /*
        |--------------------------------------------------------------------------
        | FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if ($event->foto) {

                Storage::disk('public')
                    ->delete($event->foto);
            }

            $data['foto'] = $request
                ->file('foto')
                ->store('event', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | MATERI
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('materi')) {

            if ($event->materi) {

                Storage::disk('public')
                    ->delete($event->materi);
            }

            $data['materi'] = $request
                ->file('materi')
                ->store('event/materi', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | GALERI BARU
        |--------------------------------------------------------------------------
        */

        $galeri = $event->galeri ?? [];

        if ($request->hasFile('galeri')) {

            foreach ($request->file('galeri') as $foto) {

                $galeri[] = $foto->store(
                    'event/galeri',
                    'public'
                );
            }
        }


        $data['galeri'] = !empty($galeri)
            ? array_values($galeri)
            : null;


        /*
        |--------------------------------------------------------------------------
        | UPDATE EVENT
        |--------------------------------------------------------------------------
        */

        $event->update($data);


        return redirect()
            ->route('admin.event.index')
            ->with(
                'success',
                'Event berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Event $event)
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        if ($event->foto) {

            Storage::disk('public')
                ->delete($event->foto);
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS MATERI
        |--------------------------------------------------------------------------
        */

        if ($event->materi) {

            Storage::disk('public')
                ->delete($event->materi);
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS GALERI
        |--------------------------------------------------------------------------
        */

        if ($event->galeri) {

            foreach ($event->galeri as $foto) {

                Storage::disk('public')
                    ->delete($foto);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS EVENT
        |--------------------------------------------------------------------------
        */

        $event->delete();


        return redirect()
            ->route('admin.event.index')
            ->with(
                'success',
                'Event berhasil dihapus.'
            );
    }
    /*
|--------------------------------------------------------------------------
| MEMBER PORTAL
|--------------------------------------------------------------------------
*/

    public function indexMember()
    {
        $events = Event::latest('tanggal')->get();

        return view(
            'frontend.member.event.event',
            compact('events')
        );
    }


        public function showMember(Event $event)
    {
        return view(
            'frontend.member.event.event-detail',
            compact('event')
        );
    }
    public function indexAlumni()
    {
        $events = Event::latest('tanggal')->get();

        return view(
            'frontend.alumni.event.event',
            compact('events')
        );
    }


        public function showAlumni(Event $event)
    {
        return view(
            'frontend.alumni.event.event-detail',
            compact('event')
        );
    }
    public function registeredMember()
{
    $user = auth()->user();

    $pendaftarans = \App\Models\Pendaftaran::with('event')
        ->where('user_id', $user->id)
        ->whereHas('event')
        ->latest()
        ->get();

    return view(
        'frontend.member.event.event-registered',
        compact('pendaftarans')
    );
}
}