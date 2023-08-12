<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use Illuminate\Http\Request;

class CertificatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $certificats = Certificat::all();
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try{

            $request->validate([
          
                'nom' => 'required|string|max:255',
                'organisme' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Notez le nom du champ
                'date_obtention' => 'required',  
            ]);
         

            $certificats =  new Certificat(); 
        
            $certificats->nom = $request->nom;
            $certificats->organisme = $request->organisme;
           
                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/certificats'), $imageName);

            $certificats->image = $imageName;

            // formatge de la date à gérer
        
            $certificats->date_obtention = $request->date_obtention;

    
            $certificats->save();
    
            return response()->json([
                "status_code" => 200,
                "status_message" => "Certificat enregistré avec succès",
                "data" => $certificats
            ]);

        } catch(Exception $e){

            return response()->json($e);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Certificat $certificat)
    {
        try{
            $certificat;

            return response()->json([
                "status_code" => 200,
                "status_message" => "Certificat identifié avec succès",
                "data" => $certificat
            ]);


        }catch(Exception $e){
            return response()->json($e);
        }
    }

  

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Certificat $certificat)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificat $certificat)
    {
        try{
            
            $certificat->delete();

            return response()->json([
                "status_code" => 200,
                "status_message" => "Certificat supprimé avec succès",
                "data" => $certificat
            ]);

        }catch(Exception $e){
            return response()->json($e);
        }

    }
}
