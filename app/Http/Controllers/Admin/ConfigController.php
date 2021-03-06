<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs= Config::all();
        return view('admin.config.index')->with('configs',$configs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => ['required','min:2','max:50'],
            'value' => ['required']

        ]);

        Config::create([
            'key' =>  $request->key,
            'value' => $request->value,

        ]);

        return Redirect()->route('admin.config.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = Config::where('id',$id)->first();
        return view('admin.config.edit')->with('config',$config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => ['required','min:2','max:50'],
            'value' => ['required']
        ]);

        Config::where('id',$id)->update([
            'key' =>  $request->key,
            'value' => $request->value,

        ]);

        return Redirect()->route('admin.config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Config::where('id',$id)->delete();

        return Redirect()->route('admin.config.index');
    }
}
