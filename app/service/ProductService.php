<?php 

namespace App\service;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProductService{

    public function storePublicImage($image): string
    {
        $image_name = $this->setProductName($image);

        $image->move(
            public_path('images/'),
            $image_name
        );
        $image_src = public_path('images/') . $image_name;
        Image::make($image_src)->fit(1000)->save($image_src);

        return $image_name;
    }

    public function removeFromPublic(string $src): bool
    {

        if (File::exists($src)) {
            File::delete($src);
            return true;
        }
        return false;
    }

    protected function setProductName($image): string
    {
        return Str::random(20) . '--' . $image->getClientOriginalName();
    }
}