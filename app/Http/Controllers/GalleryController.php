<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\EditGalleryRequest;
use App\Models\Gallery;
use App\Models\Image;

class GalleryController extends Controller
{
    public function index(Request $request){
        $term = $request->query('term', '');
        $userId = $request->query('userId', '');
        $galleries = Gallery::searchByTerm($term, $userId)->latest()->paginate(10);
        
        return response()->json($galleries);
    }

    public function store(CreateGalleryRequest $request){
        $data = $request->validated();
        $gallery = Gallery::create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        $imagesArr = [];
        foreach($data['images'] as $image) {
            $imagesArr[] = Image::create([
                'gallery_id' => $gallery->id,
                'url' => $image->url
            ]);
        }

        return response()->json($gallery, 201);
    }

    public function show($id){
        $gallery = Gallery::with(['images', 'user', 'comments', 'comments.user'])->find($id);
        return response()->json($gallery);
    }

    public function update(EditGalleryRequest $request, Gallery $gallery){
        $data = $request->validated();
        $gallery->update($data);
        $gallery->images()->delete();

        $imagesArr = [];
        foreach($request['images'] as $image) {
            $imagesArr[] = Image::create([
                'gallery_id' => $gallery->id,
                'url' => $image->url
            ]);
        }

        return response()->json($gallery);
    }

    public function destroy(Gallery $gallery){
        $gallery->delete();
        return response()->noContent();
    }
}
