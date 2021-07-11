<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    Store, User
};
use App\Http\Requests\StoreUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $store = Store::where('user_id', $user->id)->first();

        return view('admin.user.index', compact('user', 'store'));
    }

    public function userUpdate(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed'],
            ]);
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        return redirect()->route('user.setting')
            ->with('success', 'Data Update Successfully');
    }


    public function storeUpdate(StoreUpdateRequest $request)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $file = $request->file('image');
            $imageName = time().'.'.$file->extension();
            $file->move(public_path('storeimages'), $imageName);

            $data['image'] = $imageName;
        }

        Store::where('id', $request->store_id)->update($data);

        return redirect()->route('user.setting')
            ->with('success', 'Data Update Successfully');
    }
}
