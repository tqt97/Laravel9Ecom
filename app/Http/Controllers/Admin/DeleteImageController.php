<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class DeleteImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $media = Media::find($request->id);

        $media->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
