<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    public function index()
    {
        $clientPerPage = 10;
        $clients = Client::query()
        ->when(Request::input('search'),function($query, $search) {
            $query->where('firstname','like','%'.$search.'%')
            // ->OrWhere('email','like','%'.$search.'%')
            ;
        })
        ->orderBy('firstname', 'asc')
                        ->simplePaginate($clientPerPage);

        $allClients = count(Client::All());

        $page_count = $allClients  / $clientPerPage;
  
        return Inertia::render('Client/Index', [
            'clients' => $clients,
            'page_count' => ceil($page_count),
            'filters' => Request::only(['search'])
        ]);

        // return[
        //     'clients' => $clients,
        //     'page_count' => ceil($page_count)
        // ];

        // return response()->json([
        //     'clients' => $clients,
        //     'page_count' => ceil($page_count)
        // ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
