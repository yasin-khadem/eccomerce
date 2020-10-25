<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Resources\ImageCollection;
use App\Models\Image as ModelsImage;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageGalleryController extends Controller
{

    public function index()
    {
        return new ImageCollection(ModelsImage::orderBy('created_at','asc')->searchByUrl()->paginate(10));
    }


    public function store(GalleryRequest $request)
    {   
        dump($request->product_code);
        $product = Product::firstWhere('code', $request->product_code);
        if ($product) {
            $data['product_id'] = $product->id;
            $data['product_code'] = $request->product_code;
            $product_image_name = Str::random(10) . '-' . $request->image->getClientOriginalName();
            $data['image'] = $product_image_name;
            $image = $request->file('image');

            $image->move(
                public_path('gallery/'),
                $product_image_name
            );
            $gallery_src = public_path('gallery/') . $product_image_name;
            Image::make($gallery_src)->fit(1000)->save($gallery_src);
            ModelsImage::create($data);
            return response(['ok'], 200);
        } else {
            throw ValidationException::withMessages([
                'product_code' => 'کد را درست وارد نکردید'
            ]);
            return response(['error'], 500);
        }
    }




    public function destroy(ModelsImage $image)
    {
        $src = $image->gallery_src;
        if (File::exists($src)) {
            File::delete($src);
        }
        $image->delete();
        return response(['ok'], 200);

    }
}
