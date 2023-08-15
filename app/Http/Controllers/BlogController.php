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

        $blog = Blog::paginate(10);
        
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
                // 'user_id' => "required | integer | 'exists:users, id'  "
                'user_id' => "required | integer "
            ]);
         

            $blog =  new Blog(); 
        
            $blog->titre = $request->titre;
            $blog->contenu = $request->contenu;
           
             // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image_accroche');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/blogs'), $imageName);

            $blog->image_accroche = $imageName;



            $blog->user_id = $request->user_id;
    
            $blog->save();

            // Insertion de plusieurs images d'illustration pour un article

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
    public function update(Request $request, $id)
    {
        //

        try{

            $request->validate([
          
                'titre' => 'string|max:255',
                'contenu' => 'string',
                'image_accroche' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Notez le nom du champ
                'user_id' => "required | integer "
            ]);

            $blog = Blog::find($id);
            // dd($request->input());
            $blog->titre = $request->titre;
            $blog->contenu = $request->contenu;
            $blog->user_id = $request->user_id;


                // Traitement de l'image 'image_accroche'
                    
            $image = $request->file('image_accroche');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // dd($imageName );
            $image->move(public_path('images/blogs'), $imageName);

            $blog->image_accroche = $imageName;
    
           if( $blog->update()){

             // Insertion de plusieurs images pour un article

                if ($request->hasFile('imagebs')) {
                    foreach ($request->file('imagebs') as $image) {
                        $path = $image->store('blog_images', 'public');
            
                        $blog->imagebs()->create([
                            'path' => $path,
                        ]);
                    }
                }
        } else
        {
            Return response()->json([

                // "status_code" => 400,
                "status_message" => "Article Non update",
                "data" => $blog
            ]);
        }

            Return response()->json([

                "status_code" => 200,
                "status_message" => "Article update avec succès",
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
