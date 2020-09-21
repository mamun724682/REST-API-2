<?php

namespace App\Http\Controllers\Api;

use App\Model\Sclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = DB::table('sclasses')->get();
        return response()->json($classes);
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
            'class_name' => 'required|unique:sclasses|max:25'
        ]);

        $data = [];
        $data['class_name'] = $request->class_name;
        DB::table('sclasses')->insert($data);
        // $d = new Sclass();
        // $d->class_name = $request->class_name;
        // $d->save();

        return response('Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('sclasses')->where('id', $id)->first();
        return response()->json($data);
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
            'class_name' => 'required|max:25'
        ]);

        $data = [];
        $data['class_name'] = $request->class_name;
        DB::table('sclasses')->where('id', $id)->update($data);
        // $d = new Sclass();
        // $d->class_name = $request->class_name;
        // $d->save();

        return response('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('sclasses')->where('id', $id)->delete();
        return response('Deleted');
    }
}
