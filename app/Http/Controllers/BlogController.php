<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $blog = Blog::all();
        
        return response()->json([
            "status_code" => 200,
            "status_message" => "succès",
            "data" => $blog
        ]);

        
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        try{

            $request->validate([
          
                'titre' => 'required|string|max:255',
                'contenu' => 'required|string',
                'image_accroche' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Notez le nom du champ
                'illustrations' => 'nullable|string',  
            ]);
         

            $blog =  new Blog(); 
        
            $blog->titre = $request->titre;
            $blog->contenu = $request->contenu;
           
                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image_accroche');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/blogs'), $imageName);

            $blog->image_accroche = $imageName;

                // Traitement des images d'illustration
            $blog->images_illustration = $request->illustration;

    
            $blog->save();


            if ($request->hasFile('imagebs')) {
                foreach ($request->file('imagebs') as $image) {
                    $path = $image->store('blog_images', 'public');
        
                    $blog->imagebs()->create([
                        'path' => $path,
                    ]);
                }
            }
    
            return response()->json([
                "status_code" => 200,
                "status_message" => "Article enregistré avec succès",
                "data" => $blog
            ]);

        } catch(Exception $e){

            return response()->json($e);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {


        try{

            $blog ; 

            $imagebs = $blog->imagebs;

            return response()->json([
                "status_code" => 200,
                "status_message" => "Article enregistré avec succès",
                "data" => $blog, $imagebs
            ]);

        } catch(Exception $e){

            return response()->json($e);
        }

    }



    /**
     * Update the specified resource in storage.
     * 
     * Cette fonction a un PROBL7ME
     */
    public function update(Request $request, Blog $blog)
    {
        //

        try{

            $request->validate([
          
                'titre' => 'string|max:255',
                'contenu' => 'string',
                'image_accroche' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Notez le nom du champ
                'illustration' => 'nullable|string',  
            ]);

            // dd($request->input());
            $blog->titre = $request->titre;
            $blog->contenu = $request->contenu;

                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image_accroche');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // dd($imageName );
            $image->move(public_path('images/blogs'), $imageName);

            $blog->image_accroche = $imageName;

                // Traitement des images d'illustration
            $blog->images_illustration = $request->illustration;
    
            $blog->update();

            Return response()->json([

                "status_code" => 200,
                "status_message" => "Article mis à avec succès",
                "data" => $blog
            ]);


        }catch(Exception $e){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {

        try{
        

            $blog->delete();

            return response()->json([

                "status_code" => 200,
                "status_message" => "Article supprimé à avec succès",
                "data" => $blog

            ]);

        }catch(Exception $e){

            return response()->json($e);

        }

    }
}
