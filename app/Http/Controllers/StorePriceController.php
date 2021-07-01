<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Store, StorePrice
};
use DataTables;
use App\Http\Requests\StorePriceRequest;

class StorePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $storeId = Store::getListStore(auth()->user());
        if ($request->ajax()) {
            $data = StorePrice::with('store')->whereIn('store_id', $storeId);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('type_alias', function ($row) {
                    if ($row->type == 'print_type') {
                        return 'Jenis Print';
                    } else {
                        return 'Kertas';
                    }
                })
                ->addColumn('action', function ($row) {
                    $button = "
                        <div class='col-md-12 text-center'>
                            <a href='" . route('price.edit', $row->id) . "' class='btn btn-success btn-sm col-md-6'> Edit </a>
                            <form method='POST' action='" . route('price.destroy', $row->id) . "' class='col-md-6'>
                                <div class='row'>
                                    " . csrf_field() . "
                                    <input type='hidden' name='_method' value='DELETE'>
                                    <button type='submit' class='btn btn-danger btn-sm col-md-12'>Delete</button>
                                </div>
                            </form>
                        </div>
                    ";

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.store.setting.setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = Store::where('user_id', auth()->user()->id)->first();
        return view('admin.store.setting.create-or-update', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceRequest $request)
    {
        StorePrice::create($request->validated());
        return redirect()->route('price.index')
            ->with('success', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $price = StorePrice::findOrfail($id);
        $store = Store::where('user_id', auth()->user()->id)->first();

        return view('admin.store.setting.create-or-update', compact('price', 'store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePriceRequest $request, $id)
    {
        StorePrice::where('id', $id)->update($request->validated());
        return redirect()->route('price.index')
            ->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StorePrice::destroy($id);
        return redirect()->route('price.index')
            ->with('success', 'Data Delete Successfully');
    }
}
