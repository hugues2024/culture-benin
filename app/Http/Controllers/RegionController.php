<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request)
{
    // Récupérer les données validées
    $validatedData = $request->validated();

    if ($request->hasFile('img')) {
        $file = $request->file('img');

        // Créer le nom : nom-region.extension
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug($request->nom_region) . '.' . $extension;

        // Déplacer dans C:\xampp\htdocs\culture-benin\public\img\regions
        $file->move(public_path('img/regions'), $fileName);

        // Enregistrer le chemin relatif pour la BDD
        $validatedData['img'] = 'img/regions/' . $fileName;
    }

    Region::create($validatedData);

    return back()->with('success', 'La région a été ajoutée avec succès !');
}


    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        //
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(StoreRegionRequest $request, Region $region)
{
    // 1. Récupérer les données validées (sauf l'image pour l'instant)
    $data = $request->validated();

    // 2. Vérifier si une nouvelle image a été envoyée
    if ($request->hasFile('img')) {

        // --- ÉTAPE A : Supprimer l'ancienne image physiquement ---
        if ($region->img) {
            $oldPath = public_path($region->img);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        // --- ÉTAPE B : Traiter la nouvelle image ---
        $file = $request->file('img');

        // On génère un nom unique (nom-region + timestamp) pour éviter les conflits de cache
        $fileName = Str::slug($request->nom_region) . '-' . time() . '.' . $file->getClientOriginalExtension();

        // Déplacement dans C:\xampp\htdocs\culture-benin\public\img\regions
        $file->move(public_path('img/regions'), $fileName);

        // On met à jour le chemin dans le tableau de données
        $data['img'] = 'img/regions/' . $fileName;
    }

    // 3. Mettre à jour la base de données avec le nouveau tableau $data
    $region->update($data);

    return redirect()->route('regions.index')->with('success', 'La région a été modifiée avec succès !');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        //
        $region->delete();
        return redirect()->back()->with('deleted', 'Region deleted successfully');
    }
}
