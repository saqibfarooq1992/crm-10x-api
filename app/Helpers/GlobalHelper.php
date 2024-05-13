<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class GlobalHelper
{

    public static function getPermissionsByRoutes(): array
    {
        $routeCollection = Route::getRoutes()->get();
        $permissions = [];
        foreach ($routeCollection as $item) {
            $name = $item->action;
            if (!empty($name['as'])) {
                $permission = $name['as'];
                $permission = trim(strtolower($permission));
                $permission = preg_replace('/[\s.,-]+/', ' ', $permission);
                $ignoreRoutesStartingWith = 'sanctum|livewire|ignition|verification|dashboard|password|logout|register|login';
                $permissionFilled = trim(str_replace("user management ", "", $permission));
                if (preg_match("($ignoreRoutesStartingWith)", $permission) === 0 && filled($permissionFilled)) $permissions[] = $permissionFilled;
            }
        }

        return $permissions;
    }


    public static function is_int_mutated($var)
    {
        $tmp = (int) $var;

        return ($tmp == $var) ? true : false;
    }

    public static function getPageTitle(): string
    {
        $lastSegment = ucwords(last(request()->segments()));

        return self::is_int_mutated($lastSegment)
            ? ucwords(request()->segment(count(request()->segments()) - 1)) . ' - ' . $lastSegment
            : $lastSegment;
    }


    public static function getResourcePermissionsMethods($type): array
    {
        $resourceMethods = ['index', 'create', 'show', 'store', 'update', 'destroy'];

        foreach ($resourceMethods as $key => $method) $result[] = ["$type $method", $method];

        return $result;
    }

    public static function handleImageUpload($request)
    {
        try {
            // Check if a file is present in the request
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/profile_pics'), $fileName);
                $userData['profile_pic'] = 'uploads/profile_pics/' . $fileName;
                return $userData;
            } else {
                // Handle the case where no file is present in the request
                return null; // or handle it as appropriate for your use case
            }
        } catch (\Exception $exception) {
            // Log or handle the exception as needed
            return null; // or handle it as appropriate for your use case
        }
    }
}