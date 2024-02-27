<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class imageHelper
{
    public static function upload64x64($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {

            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->fit(64, 64, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path, 100);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function upload350x150($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {

            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->fit(350, 150, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path, 100);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function upload1920x650($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {

            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->fit(1920, 650, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path, 80);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function upload670x800($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {

            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->fit(670, 800, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path, 80);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function upload800x600($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {

            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->fit(800, 600, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path, 80);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function logo($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0777, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->save($path, 20);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function favicon($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0777, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath())->save($path);
            $img->resize(64, 64);
            $img->save($path, 100);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function footerLogo($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0777, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();
            $path = public_path($dir.'/'.$filename);
            $img = Image::make($file->getRealPath())->save($path);
            $img->save($path, 20);

            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }

    public static function upload($name, $directory, $size, $file)
    {
        $dir = 'images/'.$directory.'/'.$size;
        if (! empty($file)) {
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = $name.'-'.rand(1, 9000).'.'.$file->getClientOriginalExtension();

            $path = public_path($dir.'/'.$filename);

            $img = Image::make($file->getRealPath());
            $img->orientate();
            $img->resize(1024, null, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
            $img->save($path);

            // $img->save();
            return $dir.'/'.$filename;
        } else {
            return '';
        }
    }
}
