<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        $oldImage = $user->image;

        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $imageEx = $image->extension();
            $imageName = request()->title . time() . "." . $imageEx;
            $path = public_path('\images\users');
            $image->move($path, $imageName);

            if ($oldImage !== 'default.png') {
                $image_path =  public_path('images/users/' . $oldImage);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
            }

        } else {
            $imageName = $oldImage;
        }

        $formData = request()->all();
        if($formData['current_password'] || $formData['password']){

            $oldPassword = $formData['current_password'];
            $newPassword = $formData['password'];

            if(!$oldPassword || !$newPassword){
                return to_route('users.edit', $id)->with('error', 'Please enter password');
            }

            if (!Hash::check($oldPassword, $user->password)) {
                return to_route('users.edit', $id)->with('error', 'Incorrect password');
            }

            $user->password = Hash::make($newPassword);

        }

        $user->name = request()->name;
        $user->email = request()->email;
        $user->image =  $imageName;
        $user->save();
        return to_route('users.edit', $id)->with('message', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
