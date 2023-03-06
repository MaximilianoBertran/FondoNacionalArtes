<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StadisticsResource;
use App\Traits\ApiResponser;
use App\User;

class UserController extends Controller
{
    use ApiResponser;
    
    public function index () {
        $users = StadisticsResource::collection(User::orderBy('username', 'DESC')->get());
        return $this->successResponse(['data' => $users]);
    }
}
