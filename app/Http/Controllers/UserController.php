<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\UserRole;
use App\Utils\CommonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $commonResponse;

    public function __construct(CommonResponse $commonResponse)
    {
        $this->commonResponse = $commonResponse;
        $this->middleware('auth:api', ['except' => ['store']]);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $newUser = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password)
        ]);

        return $this->commonResponse->commonResponse(201, [$newUser]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        if ($user == null) {
            return $this->commonResponse->commonResponse(404, ['message' => 'User not found']);
        }
        return $this->commonResponse->commonResponse(200, [$user]);
    }

    /**
     * Display the specified resource.
     */
    public function me()
    {
        //
        $user = Auth::user();
        if ($user == null) {
            return $this->commonResponse->commonResponse(404, ['message' => 'User not found']);
        }
        return $this->commonResponse->commonResponse(200, [$user]);
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
