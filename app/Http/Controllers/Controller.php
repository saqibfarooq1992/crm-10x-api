<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\GlobalHelper; // Corrected namespace
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __permissions($type)
    {
        $permissions = GlobalHelper::getResourcePermissionsMethods($type);

        foreach ($permissions as $permission) $this->middleware("can:$permission[0]", ['only' => [$permission[1]]]);
    }
}
