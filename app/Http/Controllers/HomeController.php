<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function edit($id)
    {
        return view('langues.edit', compact('id'));
    }

    public function index()
    {
        // Statistiques clés
        $totalContenus = Contenu::count();
        $totalLangues = Contenu::distinct('langue_id')->count('langue_id');
        $totalCommentaires = Commentaire::count();
        $totalUsers = User::count();

        // Contenus par langue (pour le diagramme en barres)
        $contenusParLangue = Contenu::with('langue')
            ->select('langue_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('langue_id')
            ->get()
            ->mapWithKeys(fn($c) => [$c->langue->nom_langue ?? 'Inconnue' => $c->total]);

        // Commentaires par contenu (diagramme semi-circulaire)
        $commentairesParContenu = Contenu::withCount('commentaires')
            ->get()
            ->pluck('commentaires_count', 'titre');

        return view('welcome', compact(
            'totalContenus',
            'totalLangues',
            'totalCommentaires',
            'totalUsers',
            'contenusParLangue',
            'commentairesParContenu'
        ));
    }

    public function redirectCustomize()
    {
        $user = auth()->user();

        // Rediriger en fonction du rôle de l'utilisateur
        return match ($user->id_role) {
            4 => redirect()->route('home'), // Admin
            5 => redirect()->route('home'), // Manager
            default => redirect()->route('accueil'), // Utilisateur standard
        };
    }

    public function accueil()
    {
        $nbr_contenus = Contenu::count();
        $nbr_langues = Langue::count();
        $contenus = Contenu::with(['region', 'langue', 'type_contenu'])
            ->where('statut', 'actif')
            ->latest()
            ->take(9) // 3 par slide × 4 slides
            ->get();
        // Chunk into slides (3 per slide)
        $slides = $contenus->chunk(3);


        return view('home.index', compact('nbr_contenus', 'nbr_langues', 'contenus', 'slides'));
    }

    public function ShowContents()
    {
        //APRÈS (pagination complète)
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
