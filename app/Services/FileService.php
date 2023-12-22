<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Storage;
class FileService
{
    public static function saveSingleFile(Request $request,$data,$folder)
    {
        $request->validate([
            'filesingle' => 'mimes:pdf,jpg,png|max:2048',
        ]);
        $created_at = strtotime($data->created_at);
        $created_folder = strtotime(date('Y-m', $created_at));
        $created_name = strtotime(date('y-m-d H:i:s')).'_'.$data->slug;
        if($request->hasFile('filesingle'))
        {
            $file      = $request->file('filesingle');
            $fileName  = $created_name .'.' . $file->getClientOriginalExtension();
            $path       = $folder.'/'.$created_folder.'/'.$fileName;
            Storage::disk('public')->put($path,file_get_contents($file));
            self::deleteFile($data->image);
            return $path;
        }else{
            if ($data->image && File::exists('storage/'.$data->image)) {
                return $data->image;
            }
            return NULL;
        }
    }
    public static function saveImageCrop($request,$data) {
        $file = $request->avatar;
        $namefile = strtotime(date('y-m-d H:i:s')).'_'.Str::slug($request->name, '_').'.jpg';
        if (strlen($file) > 255 ){
            $file = str_replace('data:image/png;base64,', '', $file);
            $file = str_replace(' ', '+', $file);
            $path = 'avatars/'.$namefile;
            Storage::disk('public')->put($path, base64_decode($file));
            self::deleteFile($data->avatar);
            return $path;// $avatar = 'avatars/'.$namefile;
        }else if (strlen($file) > 0 ){
            if ($data->avatar && File::exists('storage/'.$data->avatar)) {
                $path = $data->avatar;
            }else{
                $path = NULL;
            }
        }else if (strlen($file) == 0){
            self::deleteFile($data->avatar);
            $path = NULL;
        }
        return $path;
    }
    public static function saveMultipleFile(Request $request,$arrData, $folder)
    {
        $files = [];
        if ($request->file('filemultiple')){
            $created_at = strtotime($arrData['data']->created_at);
            $created_folder = strtotime(date('Y-m', $created_at));
            $created_name = strtotime(date('y-m-d H:i:s')).'_gl_'.$arrData['data']->slug;
            foreach($request->file('filemultiple') as $key => $file)
            {
                $key += $arrData['serial_id'] + 1;
                $fileName = $created_name . '_'. str_pad($key,2,"0",STR_PAD_LEFT) .'.' . $file->getClientOriginalExtension();
                $path       = $folder.'/'.$created_folder.'/'.$fileName;
                Storage::disk('public')->put($path,file_get_contents($file));
                $files[$key] = $path;
            }
        }
        return $files;
    }
    public static function deleteFile($file)
    {
        if ($file) {
            if(File::exists('storage/'.$file))
            {
                Storage::disk('public')->delete($file);
            }
        }
    }


}
