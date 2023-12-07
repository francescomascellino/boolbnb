<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Message;
use Illuminate\Support\Str;
use App\Models\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.apartments.index', ['apartments' => Apartment::where('user_id', Auth::user()->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.apartments.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $val_data = $request->validated();

        $apartment = Apartment::create([
            'user_id' => Auth::user()->id,
            'title' => $val_data['title'],
            'slug' => Str::slug($val_data['title']),
            'description' => $val_data['description'],
            'rooms' => $val_data['rooms'],
            'beds' => $val_data['beds'],
            'bathrooms' => $val_data['bathrooms'],
            'square_meters' => $val_data['square_meters'],
            'address' => $val_data['address'],
            'latitude' => ((rand(0, 90000000) / 1000000) * (rand(0, 1) ? 1 : -1)),
            'longitude' => ((rand(0, 180000000) / 1000000) * (rand(0, 1) ? 1 : -1)),
            'is_visible' => $val_data['is_visible'],
        ]);

        $apartment->services()->attach($request->services);

        return to_route('admin.apartments.index')->with('message', 'Apartment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', ['apartment' => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdateApartmentRequest $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        /* TO DO:
            - eliminazione immagini dalla tabella images che sono associate a questo appart
            - applicazione metodo detach alla tabella apartment_image
            - chiudere l'eventuale sponsorship attiva (necessario? tanto ho già pagato, si può lasciar scadere)
            - le statistiche di questo appartamento vanno eliminate?
        */

        // eliminazione messaggi associati a questo appartamento
        $messages = Message::where('apartment_id', $apartment->id)->delete();

        //applicazione metodo detach alla tabella apartment_service
        $apartment->services()->detach();

        $apartment->delete();

        return to_route('admin.apartments.index')->with('message', 'appartamento eliminato con successo!');
    }
}
