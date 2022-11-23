<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konser;

class KonserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Konser::all();
        return response()->json([
            'data' => $data
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Konser = Konser::create($request->all());
        $Konser->save();

        $data_akhir = Konser::all();
        return $data_akhir;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find = Konser::where('id',$id)->first();
        return $find;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $siswa_update = Konser::where('id',$id)->update($request->all());
        return $siswa_update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa_delete = Konser::find($id);
        if ($siswa_delete){
            $siswa_delete->delete();
            return response()->json([
                "message"=>"Data berhasil di hapus",
                "data"=>$siswa_delete
            ]);
        }else{
            return response()->json([
                "message"=>"Data tidak ditemukan"
            ]);
        }
    }
}
