<?php

namespace App\Http\Controllers;

use App\Models\Konyv;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KonyvController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Konyv::with('olvaso')->get());
    }

    public function show(Konyv $konyv): JsonResponse
    {
        return response()->json($konyv->load('olvaso'));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validated($request);
        $konyv = Konyv::create($data);
        return response()->json($konyv->load('olvaso'), 201);
    }

    public function update(Request $request, Konyv $konyv): JsonResponse
    {
        $data = $this->validated($request, $konyv);
        if ($konyv->olvaso_id !== null && $data['olvaso_id'] !== $konyv->olvaso_id) {
            return response()->json(['message' => 'A mar kikolcsonzott konyv nem rendelheto masik olvasohoz visszahozas elott.'], 409);
        }
        $konyv->update($data);
        return response()->json($konyv->load('olvaso'));
    }

    public function destroy(Konyv $konyv): JsonResponse
    {
        $konyv->delete();
        return response()->json(null, 204);
    }

    public function szabad(): JsonResponse
    {
        return response()->json(Konyv::whereNull('olvaso_id')->get());
    }

    public function kereses(Request $request): JsonResponse
    {
        $data = $request->validate(['szoveg' => ['required','string','max:200']]);
        $term = $data['szoveg'];
        return response()->json(Konyv::with('olvaso')->where(fn ($query) => $query
            ->where('cim', 'like', "%{$term}%")
            ->orWhere('szerzo', 'like', "%{$term}%"))->get());
    }

    private function validated(Request $request, ?Konyv $konyv = null): array
    {
        return $request->validate([
            'cim' => ['required','string','max:150'],
            'szerzo' => ['required','string','max:100'],
            'isbn' => ['required','string','max:20', Rule::unique('konyvek', 'isbn')->ignore($konyv?->id)],
            'kiadas_eve' => ['required','integer','min:0','max:2100'],
            'olvaso_id' => ['sometimes','nullable','integer','exists:olvasok,id'],
        ]);
    }
}
