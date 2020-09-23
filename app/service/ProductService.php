<?php 

namespace App\service;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProductService{

    public function storePublicImage($image): string
    {
        $image_name = $this->setProductName($image);

        $image->move(
            public_path('images/'),
            $image_name
        );

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