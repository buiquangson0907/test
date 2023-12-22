<?php
namespace App\Http\Controllers\Admin\Account;
use Illuminate\Support\Str;
use App\Services\FileService;

class ServiceAccount
{

    const FOLDER_AVATAR = "avatar";

    public static function isVerifyCreate()
    {
        return auth()->guard('admin')->user()->hasAnyPermission('super-add');
    }
    public static function isVerifyEdit($data)
    {
        return (
                auth()->guard('admin')->user()->hasAnyPermission('super-edit') &&
                self::isCheckLessEqualRole($data->role) &&
                self::isCheckOwnerAccount($data->role,$data->id)
            );
    }

    protected static function isCheckLessEqualRole($role)
    {
        return (auth()->guard('admin')->user()->role <= $role);
    }
    protected static function isCheckOwnerAccount($role,$id)
    {
        return !(self::isSameRole($role) && !self::isSameAccount($id));
    }

    protected static function isSameRole($role)
    {
        return (auth()->guard('admin')->user()->role == $role);
    }
    protected static function isSameAccount($id)
    {
        return (auth()->guard('admin')->user()->id == $id);
    }

    public static function isVerifyRequestRole($requestRole)
    {
        return (auth()->guard('admin')->user()->role < $requestRole && $requestRole <= 3);
    }

    protected static function isCheckLessRole($role)
    {
        return (auth()->guard('admin')->user()->role < $role);
    }
    public static function isVerifyPublish($role)
    {
        return (
            auth()->guard('admin')->user()->hasAnyPermission('super-publish') &&
            self::isCheckLessRole($role)
        );
    }

    public static function isVerifyDestroy($data)
    {
        return (
            auth()->guard('admin')->user()->hasAnyPermission('super-delete') &&
            self::isCheckLessRole($data->role) &&
            ($data->status == 0)
        );
    }

    public static function saveImage($request,$account)
    {
        return FileService::saveImageCrop($request,$account,self::FOLDER_AVATAR);
    }

    public static function deleteFile($file)
    {
        FileService::deleteFile($file);
    }
}
