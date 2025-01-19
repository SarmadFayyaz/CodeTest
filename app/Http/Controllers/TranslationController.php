<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Cache;

class TranslationController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show', 'search'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = Translation::paginate($request->has('perPage') && !empty($request->input('perPage')) ? $request->perPage : 50);
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'language_id' => 'required|integer|exists:languages,id',
            'key' => 'required|max:255|unique:translations,key,NULL,id,language_id,' . $request->language_id,
            'content' => 'required',
            'tag' => 'nullable|max:255',
        ]);
        $response = Translation::create($params);
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Translation $translation)
    {
        return response()->json($translation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Translation $translation)
    {
        $params = $request->validate([
            'language_id' => 'required|integer|exists:languages,id',
            'key' => 'required|max:255|unique:translations,key,NULL,id,language_id,' . $request->language_id,
            'content' => 'required',
            'tag' => 'nullable|max:255',
        ]);
        $translation->update($params);
        return response()->json($translation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translation $translation)
    {
        $translation->delete();
        return response()->json(['message', "Language deleted"]);
    }


    public function search(Request $request)
    {
        $cacheKey = 'translations_' . md5(json_encode($request->all()));

        $response = Cache::remember($cacheKey, 3600, function () use ($request) {
            $data = Translation::query()->orderBy("content");

            $data->when($request->filled('key'), function ($query) use ($request) {
                $query->where("key", 'like', '%' . $request->key . '%');
            });

            $data->when($request->filled('language_id'), function ($query) use ($request) {
                $query->where("language_id", $request->language_id);
            });

            $data->when($request->filled('content'), function ($query) use ($request) {
                $query->where("content", 'like', '%' . $request->content . '%');
            });

            $data->when($request->filled('tag'), function ($query) use ($request) {
                $query->where("tag", $request->tag);
            });

            return $data->paginate($request->has('perPage') && !empty($request->input('perPage')) ? $request->perPage : 50); // Use pagination
        });

        return response()->json($response);
    }
}
