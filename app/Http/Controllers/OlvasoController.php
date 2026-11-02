<?php

namespace App\Http\Controllers;

use App\Models\Olvaso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OlvasoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Olvaso::with('konyvek')->get());
    }

    public function show(Olvaso $olvaso): JsonResponse
    {
        return response()->json($olvaso);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(['nev' => ['required','string','max:100'], 'email' => ['required','email','max:100', Rule::unique('olvasok', 'email')]]);
        return response()->json(Olvaso::create($data), 201);
    }

    public function update(Request $request, Olvaso $olvaso): JsonResponse
    {
        $data = $request->validate(['nev' => ['required','string','max:100'], 'email' => ['required','email','max:100', Rule::unique('olvasok', 'email')->ignore($olvaso->id)]]);
        $olvaso->update($data);
        return response()->json($olvaso);
    }

    public function destroy(Olvaso $olvaso): JsonResponse
    {
        $olvaso->konyvek()->update(['olvaso_id' => null]);
        $olvaso->delete();
        return response()->json(null, 204);
    }

    public function konyvek(Olvaso $olvaso): JsonResponse
    {
        return response()->json($olvaso->konyvek()->get());
    }

    public function kolcsonzok(): JsonResponse
    {
        return response()->json(Olvaso::whereHas('konyvek')->with('konyvek')->get());
    }
}
