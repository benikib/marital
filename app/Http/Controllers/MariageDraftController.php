<?php

namespace App\Http\Controllers;

use App\Models\MariageDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MariageDraftController extends Controller
{
    
    // Store or update a draft
    public function store(Request $request)
    {
        $payload = $request->input('data', []);
        $draftId = $request->input('id');

        // Handle embedded data URLs for files: save to storage and replace with path
        $filesSaved = [];
        foreach ($payload as $key => $value) {
            if (is_string($value) && str_starts_with($value, 'data:')) {
                // data:[mime];base64,[data]
                if (preg_match('/data:(image\/[^;]+);base64,(.*)$/', $value, $m)) {
                    $mime = $m[1];
                    $data = base64_decode($m[2]);
                    $ext = explode('/', $mime)[1] ?? 'jpg';
                    $filename = 'draft_' . time() . '_' . Str::random(8) . '.' . $ext;
                    $path = 'photos/drafts/' . $filename;
                    Storage::disk('public')->put($path, $data);
                    $filesSaved[$key] = $path;
                    // replace payload value by path (so it's easier to restore preview)
                    $payload[$key] = Storage::url($path);
                }
            }
        }

        if ($draftId) {
            $draft = MariageDraft::find($draftId);
            if ($draft) {
                $draft->update([
                    'data' => $payload,
                    'files' => $filesSaved,
                ]);
                return response()->json(['id' => $draft->id, 'message' => 'Draft updated']);
            }
        }

        $draft = MariageDraft::create([
            'user_id' => auth()->id(),
            'data' => $payload,
            'files' => $filesSaved,
        ]);

        return response()->json(['id' => $draft->id, 'message' => 'Draft saved']);
    }

    public function show(MariageDraft $mariageDraft)
    {
        return response()->json($mariageDraft);
    }

    public function destroy(MariageDraft $mariageDraft)
    {
        // Optionally delete files
        if ($mariageDraft->files) {
            foreach ($mariageDraft->files as $p) {
                if (Storage::disk('public')->exists($p)) Storage::disk('public')->delete($p);
            }
        }
        $mariageDraft->delete();
        return response()->json(['message' => 'Draft deleted']);
    }
}
