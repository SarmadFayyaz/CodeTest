<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LanguageController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = Language::paginate($request->has('perPage') && !empty($request->input('perPage')) ? $request->perPage : 50);
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:2|unique:languages,code',
        ]);
        $response = Language::create($params);
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return response()->json($language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $params = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:2|unique:languages,code,' . $language->code . ',code',
        ]);
        $language->update($params);
        return response()->json($language);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $language->delete();
        return response()->json(['message', "Language deleted"]);
    }
}
