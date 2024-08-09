<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Counter;
use App\Models\SubService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subservice = SubService::where('id', 1)->first();
        $services = Service::where('id_sub_services', 1)->get();
        $counters = Counter::where('id_sub_services', 1)->get();

        return view("fe.services.index", compact('services', 'counters', 'subservice'));
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
    public function show($id)
    {
        // Mencari SubService berdasarkan ID
        $subservice = SubService::findOrFail($id);
        $services = Service::where('id_sub_services', $id)->get();
        $counters = Counter::where('id_sub_services', $id)->get();

        // Mengembalikan view dengan data yang diambil
        return view('fe.services.index', compact('subservice', 'services', 'counters'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
