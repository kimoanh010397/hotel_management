<?php

namespace App\Http\Controllers;
use App\Model\Customer;
use App\Model\Room;
use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CommentController extends Controller
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
    public function create(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
//        dd(comment::all());
        //
        if (!Auth::guard('customer')->check())
            return redirect()->back()->with('status', 'Please log in before comment !');
        $customer = Auth::guard('customer')->user()->id;
        $params = $request->all();
        $id = $params['id'];
        $dataInsert = [
            'content'=>$params['content'],
            'id_customer' => $customer,
            'id_room' =>$id
        ];
        try {
            DB::beginTransaction();

            Comment::insert($dataInsert);

            DB::commit();

            return redirect(route('room.show',$id))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('room.show',$id))->with('error', 'thêm mới thất bại.');
        }

//        dd($id);

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
        //
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
    public function  storeCommentAjax(Request $request){

//        $customer = Auth::guard('customer')->user()->id;
//        $id = $request->id;
//
//        $dataInsert = [
//            'content'=>$request->content,
//            'id_customer' => $customer,
//            'id_room' =>$id
//        ];
//        try {
//            DB::beginTransaction();
//
//            Comment::create($dataInsert);
//
//            DB::commit();
//            $list_comment = Comment::with('customer')->get();
//            return response()->json($list_comment);
//        } catch (\Exception $exception) {
//            DB::rollBack();
//        }
    }
}
