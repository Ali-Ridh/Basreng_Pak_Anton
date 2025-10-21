<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download(Attachment $attachment)
    {
        if (!Storage::disk('public')->exists($attachment->path)) {
            abort(404);
        }
        return Storage::disk('public')->download($attachment->path, $attachment->original_filename);
    }

    public function show(Attachment $attachment)
    {
        if (!Storage::disk('public')->exists($attachment->path)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($attachment->path);
        $mimeType = $attachment->mime_type;

        return response($file)->header('Content-Type', $mimeType);
    }
}
