<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfileImage;
use App\Http\Resources\UserResource;
use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $output = UserResource::collection($users);
        return response()->json(
            [
                'status' => true,
                'message' => 'done',
                'data' => $output
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($uID)
    {

        $user = User::find($uID);
        if (!$user) {
            return json_response(false, 'Invalid User', null, 400);
        }
        $output = new  UserResource($user);
        return json_response(true, 'done', $output, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $uID
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $uID)
    {

        $input = $request->all();
        $validator = Validator::make(
            $request->all(), [
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($validator->fails()) {
            return json_response(false, 'Validation  Error', null, 400);
        }

        $profileImageUrl =null;

        // validate only profile image
        if (isset($input['profile_image'])) {
            $validator = Validator::make(
                $request->all(), [
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return json_response(false, 'Validation  Error Image', null, 400);
            }
            // upload image url
            $profileImageUrl = fileUploadUrl($input, 'profile_image', 'profile_image', '_' . md5($uID));

        }
        $user = User::find($uID);
        if (!$user) {
            return json_response(false, 'Invalid User', null, 400);
        }
        $user->name = $input['first_name'] . ' ' . $input['last_name'];
        if (isset($input['profile_image'])) {
            $user->profile_image = $profileImageUrl;
        }
        $user->save();
        $userData = User::find($uID);
        $output = new  UserResource($userData);
        return json_response(true, 'user info updated', $output, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
