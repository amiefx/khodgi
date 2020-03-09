<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeSection as HomeSectionResource;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use App\HomeSection;

class HomeSectionController extends Controller
{
    public function index()
    {
        return response()->json([
            'homesections' => HomeSectionResource::collection(Homesection::all()),
        ], 200);
    }

    // public function store(Request $request)
    // {
    //     $homesections = Homesection::create([
    //         'name' => $request->name,
    //         'image' => $request->image,
    //         'small_image' => $request->small_image,
    //         'link' => $request->link,
    //         'is_active' => $request->is_active,
    //     ]);
    //     return response()->json(['homesection' => new HomeSectionResource($homesections),
    //     'images' => Homesection::pluck('large_images')->all()],
    //     200);
    // }

    public function store(Request $request)
    {
       // if ($request->image) {
             $name = str_random().'.'.explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
             \Image::make($request->image)->resize(600, 800)->save(public_path('storage/images/').$name);
           // $request->image = $name;
      //  }

        //   $smallname = str_random().'.'.explode('/', explode(':', substr($request->small_image, 0, strpos($request->small_image, ';')))[1])[1];
        //   \Image::make($request->small_image)->resize(600, 800)->save(public_path('storage/images/').$smallname);

        // $xploded = explode(',', request()->small_image);
        // $decoded = base64_decode($xploded[1]);
        // if (str_contains($xploded[0], 'jpeg'))
        //     $extension = 'jpg';
        // else
        //     $extension = 'png';

        // $fileName = 'storage/images/'.time().'.'.$extension;
        // $path = public_path().'/'.$fileName;
        // file_put_contents($path, $decoded);

        $homesections = Homesection::create([
                'name' => $request->name,
                'image' =>  'images/'.$name,
                'link' => $request->link,
                'is_active' => $request->is_active,
            ]);
            return response()->json(['homesection' => new HomeSectionResource($homesections)], 200);
    }

    public function update(Request $request, $id)
    {
        $homesections = Homesection::find($id);

        $homesections->update([
            'name' => $request->name,
            'link' => $request->link,
            'is_active' => $request->is_active,
        ]);
        return response()->json(['homesection' => new HomeSectionResource($homesections)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homesection = Homesection::find($id)->delete();
        return response()->json(['homesection' => $homesection], 200);
    }

    public function changePhoto(Request $request)
    {
        $homesection = Homesection::find($request->homesection);

        $ext = $request->photo->extension();
        $photo = $request->photo->storeAs('images', Str::random(16).".{$ext}", 'public');
        $homesection->image = $photo;
        $homesection->save();

        return response()->json(['homesection' => new HomeSectionResource($homesection)], 200);
    }

    // public function changePhotoS(Request $request)
    // {
    //     $homesection = Homesection::find($request->homesection);

    //     $ext = $request->photo->extension();
    //     $photo = $request->photo->storeAs('images', Str::random(16).".{$ext}", 'public');
    //     $homesection->small_image = $photo;
    //     $homesection->save();

    //     return response()->json(['homesection' => new HomeSectionResource($homesection)], 200);
    // }
}
