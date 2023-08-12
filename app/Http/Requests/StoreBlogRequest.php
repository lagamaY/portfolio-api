<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Validation\Rule;
// use Illuminate\Validation\Rules\File;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            
            // 'titre' => 'required|string|max:255',
            // 'contenu' => 'required|string',
            // 'image_accroche' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Notez le nom du champ
            // 'illustration' => 'nullable|string',         
        ];
    }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException( response()->json([

    //         'success' => false,
    //         'error' => true,
    //         'message' => 'Erreur de validation', 
    //         'errorList' => $validator->errors()
    //     ])
    //     );
    // }

    // public function messages(){

    //     return [
    //         'titre.required'=> 'Vous devez entrer un titre svp !',
    //         'contenu.required'=> 'Veuillez saisir le contenu svp!',
    //         'image_accroche.required' => 'Veuillez entrer une image svp !'
    //     ];  
    // }
}
