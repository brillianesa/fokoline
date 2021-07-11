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
            'storeaddr' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'lat' => 'required',
            'lng' => 'required',
            'notelp' => 'required|numeric',
            'payment' => 'required'
        ]);

        $file = $request->file('img');
        $imageName = time().'.'.$file->extension();
        $file->move(public_path('storeimages'), $imageName);

        //store image to DB here..
        $data = [
            'user_id' => Auth::user()->id,
            'image' => $imageName,
            'name' => $request->storename,
            'address' => $request->storeaddr,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'phone_number' => $request->notelp,
            'payment_list' => json_encode($request->payment)
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
        $param = strtolower($request->toArray()['search']);
        $data = Store::select(['name as label', 'latitude as lat', 'longitude as lng', 'address as addr'])
                ->whereRaw('lower(name) like (?)',["%{$param}%"])
                ->where('is_verified',1)
                ->get();

        return response()->json($data);
    }

    public function getNearbyStore(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $data = Store::select('id', 'name', 'address', 'latitude', 'longitude', 'image')
                ->selectRaw("111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS($latitude))
                    * COS(RADIANS(latitude))
                    * COS(RADIANS($longitude - longitude))
                    + SIN(RADIANS($latitude))
                    * SIN(RADIANS(latitude))))) AS distance")
                ->orderBy('distance', 'asc')
                ->limit(5)
                ->get();

        return response()->json($data);
    }
}
