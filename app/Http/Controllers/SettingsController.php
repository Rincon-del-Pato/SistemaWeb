<?php

namespace App\Http\Controllers;

use App\Enums\Ciudad;
use App\Enums\Region;
use App\Models\Tables;
use App\Models\settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $settings = Settings::first();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $setting = new Settings;
        return view('settings.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            Settings::$rules
        ]);

        Settings::create([
            'name' => $request->name,
            'ruc' => $request->ruc,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'logo' => $request->logo,
            'province' => $request->province,
            'city' => $request->city,
        ]);

        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(settings $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(settings $setting)
    {
        //
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, settings $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(settings $settings)
    {
        //
    }
}
