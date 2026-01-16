<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Affiche le Dashboard (Admin/Manager)
    public function index()
    {
        $totalContenus = Contenu::count();
        $totalLangues = Langue::count();
        $totalCommentaires = Commentaire::count();
        $totalUsers = User::count();

        $contenusParLangue = Contenu::with('langue')
            ->select('langue_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('langue_id')
            ->get()
            ->mapWithKeys(fn($c) => [$c->langue->nom_langue ?? 'Inconnue' => $c->total]);

        $commentairesParContenu = Contenu::withCount('commentaires')
            ->get()
            ->pluck('commentaires_count', 'titre');
        
        // On récupère aussi les régions au cas où le dashboard en a besoin
        $regions = Region::all();

        return view('welcome', compact(
            'totalContenus',
            'totalLangues',
            'totalCommentaires',
            'totalUsers',
            'contenusParLangue',
            'commentairesParContenu',
            'regions'
        ));
    }

    // Affiche la page d'accueil publique (Culture-Bénin)
    public function accueil()
    {
        $nbr_contenus = Contenu::count();
        $nbr_langues = Langue::count();
        
        // RÉCUPÉRATION DES RÉGIONS POUR LA VUE
        $regions = Region::all(); 

        $contenus = Contenu::with(['region', 'type_contenu'])
            ->where('statut', 'actif')
            ->latest()
            ->get();

        // On envoie bien 'regions' à la vue home.index
        return view('home.index', compact(
            'nbr_contenus', 
            'nbr_langues', 
            'contenus', 
            'regions'
        ));
    }

    public function redirectCustomize()
    {
        $user = auth()->user();
        return match ($user->id_role) {
            4 => redirect()->route('home'), // Admin -> Dashboard
            5 => redirect()->route('home'), // Manager -> Dashboard
            default => redirect()->route('accueil'), // User -> Accueil publique
        };
    }

    public function ShowContents()
    {
        $contents = Contenu::with(['region', 'langue', 'type_contenu'])
            ->where('statut', 'actif')
            ->latest()
            ->paginate(12);
        return view('home.contents', compact('contents'));
    }

    public function ShowContentDetail(Contenu $contenu)
    {
        return view('home.detail', compact('contenu'));
    }
}