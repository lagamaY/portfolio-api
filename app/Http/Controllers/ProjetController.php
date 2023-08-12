<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Technologie;
use Illuminate\Http\Request;


class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       try{

        $projets = Projet::all();


        return response()->json([
            "status_code" => 200,
            "status_message" => "Tous les projets ont bien été récupérés",
            "data" => $projets
        ]);

        }catch(Exception $e){
            return response()->json($e);
        }

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try{

            $request->validate([
          
                'nom' => 'required|string|max:255',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'lien' => 'nullable',
                'description' => '',
                'images' => '',
                'techno_utilisees' => 'array', // 404 lorsque j'ajoute required
            ]);
         
            // Comment faire un select sur insomnia ?

            $projets =  new Projet(); 
        
            $projets->nom = $request->nom;
           
                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('logo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/projets'), $imageName);

            $projets->logo = $imageName;

            $projets->lien = $request->lien;
            $projets->description = $request->description;
            $projets->images= $request->images;
            

    
            $projets->save();

            
            if ($request->hasFile('imageps')) {
                foreach ($request->file('imageps') as $image) {
                    $path = $image->store('projets_images', 'public');
        
                    $projets->imageps()->create([
                        'path' => $path,
                    ]);
                }
            }

            $projets->technologies()->attach($request->input('techno_utilisees'));

    
            return response()->json([
                "status_code" => 200,
                "status_message" => "Projet enregistré avec succès",
                "data" =>  $projets
                
            ]);

        } catch(Exception $e){

            return response()->json($e);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        try{

            $projet;
            $imageps = $projet->imageps;


            return response()->json([
                "status_code" => 200,
                "status_message" => "Projet trouvé",
                "data" => $projet, $imageps

                
            ]);


        }catch(Exception $e){
            return response()->json($e);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        try{
            
            $projet->delete();

            return response()->json([
                "status_code" => 200,
                "status_message" => "Projet supprimé avec succès",
                "data" => $projet
            ]);

        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
