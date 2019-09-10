<?php
namespace App\Traits;

trait Uploads
{
    protected function upload($file, $directory) {
      $name = $file->getClientOriginalName();
      $filename = microtime(true) . '-' . $name;
      $path = public_path() . $directory;
      $file->move($path, $filename);
      return (Object) ['name' => $name, 'link' => $directory . $filename];
    }
}
