<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'storename' => 'required',
            'bankacc' => 'required',
            'accnum' => 'required',
            'storeaddr' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $file = $request->file('img');
        $imageName = time().'.'.$file->extension();
        $file->move(public_path('storeimages'), $imageName);

        //store image to DB here..
        $data = [
            'user_id' => Auth::user()->id,
            'image' => $imageName,
            'name' => $request->storename,
            'bank' => $request->bankacc,
            'rekening_number' => $request->accnum,
            'address' => $request->storeaddr,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
        ];
        // dd();
        $store = Store::create($data);

        return redirect(route('homepage'));
    }

    //Store detail
    public function detail($id)
    {
        $store = Store::find($id);
        return json_encode($store);
    }

    //Autocomplete find Store
    public function autocomplete(Request $request)
    {
        $param = $request->toArray()['search'];
        $data = Store::select(['name as label', 'latitude as lat', 'longitude as lng', 'address as addr'])
                ->where("name","LIKE","%{$param}%")
                ->get();

        return response()->json($data);
    }
}
