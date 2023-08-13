<?php

namespace App\Http\Controllers;

use App\Models\Technologie;
use Illuminate\Http\Request;

class TechnologieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technologie::all();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try{

            $request->validate([
          
                'nom' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
               
            ]);
         

            $technologies =  new Technologie(); 
        
            $technologies->nom = $request->nom;
           
                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/technologies'), $imageName);

            $technologies->image = $imageName;

    
            $technologies->save();
    
            return response()->json([
                "status_code" => 200,
                "status_message" => "Technologie enregistrée avec succès",
                "data" => $technologies
            ]);

        } catch(Exception $e){

            return response()->json($e);
        }
        
    }




    /**
     * Display the specified resource.
     */
    public function show(Technologie $technologie)
    {
        
        try{

            $technologie;

            return response()->json([
                "status_code" => 200,
                "status_message" => "Technologie identifiée avec succès",
                "data" => $technologie
            ]);


        }catch(Exception $e){
            return response()->json($e);
        }
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{

            $request->validate([
          
                'nom' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
               
            ]);
         

            $technologies =  Technologie::find($id); 
        
            $technologies->nom = $request->nom;
           
                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/technologies'), $imageName);

            $technologies->image = $imageName;

    
            $technologies->update();
    
            return response()->json([
                "status_code" => 200,
                "status_message" => "Technologie Update avec succès",
                "data" => $technologies
            ]);

        } catch(Exception $e){

            return response()->json($e);
        }
        
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technologie $technologie)
    {
        try{
            
            $technologie->delete();

            return response()->json([
                "status_code" => 200,
                "status_message" => "Technologie supprimée avec succès",
                "data" => $technologie
            ]);

        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
