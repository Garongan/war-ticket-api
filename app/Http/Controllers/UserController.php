<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\UserRole;
use App\Utils\CommonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $commonResponse;

    public function __construct(CommonResponse $commonResponse)
    {
        $this->commonResponse = $commonResponse;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', UserRole::User)->paginate(10);
        if ($users == null) {
            return $this->commonResponse->commonResponse(404, ['message' => 'Users not found']);
        }
        return $this->commonResponse->commonResponse(200, [$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $validators = Validator::make(request(['name', 'email', 'password']), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validators->fails()) {
            return $this->commonResponse->commonResponse(401, ['message' => $validators->errors()]);
        }

        User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password)
        ]);

        return $this->commonResponse->commonResponse(201, ['message' => 'User registered successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
