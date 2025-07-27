<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    /**
     * Display a listing of all users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all(); // You can also paginate with User::paginate(10);
        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }
}