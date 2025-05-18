<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::with(['category','photos','favorite','user'])->get();
        return AnnouncementResource::collection($announcements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'title' => 'required|string|max:50',
                'operation' => 'required|in:vente,echange,don',
                'school_level' => 'required|in:1ère primaire', '2ème primaire', '3ème primaire',
                'is_completed' => 'required',
                'is_canceled' => 'required',
                'exchange_location' => 'required|string',
                'exchange_location_lat' => 'required|double',
                'exchange_location_logt' => 'required|double'
            ]);

            $announcement = Announcement::create($validated);
            return new AnnouncementResource($announcement);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $announcement = Announcement::find($id);
            if(!$announcement){
                return response()->json([
                    'error' => 'announcement not found'
                ]);
            }
            return new AnnouncementResource($announcement);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{

            $announcement = Announcement::find($id);
            if(!$announcement){
                return response()->json([
                    'error' => 'announcement not found'
                ]);
            }

            $validated = $request->validate([
                'title' => 'required|string|max:50',
                'operation' => 'required|in:vente,echange,don',
                'school_level' => 'required|in:1ère primaire', '2ème primaire', '3ème primaire',
                'is_completed' => 'required',
                'is_canceled' => 'required',
                'exchange_location' => 'required|string',
                'exchange_location_lat' => 'required|double',
                'exchange_location_logt' => 'required|double'
            ]);

            $announcement = Announcement::update($validated);
            return new AnnouncementResource($announcement);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::find($id);
        if(!$announcement){
            return response()->json([
                'error' => 'announcement not found'
            ]);
        }

        $announcement->delete();
        return response()->json([
            'data' => 'announcement deleted'
        ]);
    }


    public function getHeight(){
        $announcements = Announcement::with(['photos','category','favorite','user'])->latest()->take(8)->get();
        return AnnouncementResource::collection($announcements);
    }

    public function filterAnnouncement(Request $request)
    {
        // Récupération des paramètres
        $operation_type = $request->query('operation_type');
        $school_level = $request->query('school_level');
        $price = $request->query('price');
        $state = $request->query('state');

        // Conversion en tableau si nécessaire
        // verifie si la valeur est null elle retourne null
        // si la valeur est un tableau elle retourne tel quel
        // si c'est une chaine de caractere elle la convertie en tableau
        $toArray = function($value) {
            if (is_null($value)) return null;
            return is_array($value) ? $value : explode(',', $value);
        };

        $query = Announcement::with(['photos', 'favorite', 'user', 'category']);

        // Filtrage conditionnel
        if ($operation_type) {
            $operation_types = $toArray($operation_type);
            $query->whereIn('operation_type', $operation_types);
        }

        if ($school_level) {
            $school_levels = $toArray($school_level);
            $query->whereIn('school_level', $school_levels);
        }

        if ($price) {
            $prices = $toArray($price);
            $query->whereIn('price', $prices);
        }

        if ($state) {
            $states = $toArray($state);
            $query->whereIn('state', $states);
        }

        $announcements = $query->get();

        return AnnouncementResource::collection($announcements);
    }
}
