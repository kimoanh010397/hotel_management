<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Room;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function create($id)
    {
        $data = [];
        $room = Room::findOrFail($id);
        $data['room'] = $room;
        return view('admin.sliders.create',$data);
    }

    public function store(Request $request)
    {
//        dd($request->image[0]->getClientOriginalName());
        $data = [];
        if($request->hasFile('images')){
            $img = $request->file('images');
            foreach ($img as $key => $value)
            {
                $img_name = $value->getClientOriginalName();
//                dd($img_name);
                $destinationPath = public_path('slide_room');
//                dd($destinationPath);
                $move = $value->move($destinationPath, $img_name);
                if($move)
                {
                    $data[] = [
                        'filename' =>   $img_name,
                        'url' => $destinationPath,
                        'room_id' => $request->room_id,
                    ];
                }
            }
        }
//        dd($data);

        try {
            DB::beginTransaction();

            Slider::insert($data);
            DB::commit();

            return redirect(route('admin.room.show',$request->room_id))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('admin.room.index'))->with('error', 'thêm mới thất bại.' . $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $data = [];
        $slider = Slider::where('room_id',$id)->get();
        $data['slider'] = $slider;

        $room = Room::findOrFail($id);
        $data['room'] = $room;

        return view('admin.sliders.edit',$data);
    }

    public function show($id)
    {
        $data = [];
        $room = Room::findOrFail($id);
//        dd($room);
        $data['room'] = $room;
        return view('admin.sliders.show',$data);
    }

    public function deleteimg($id)
    {
        try {
            DB::beginTransaction();
            Slider::findOrFail($id)->delete();
            DB::commit();

            return response()->json([
                'success' => 'Delete successful.'
            ]);

//            return redirect()->route('category.index')->with('seccess','Delete successful.');
        }catch (\Exception $exception){
            DB::rollBack();

            return response()->json([
                'error' => 'Delete fail.'
            ]);
//            return redirect()->route('category.index')->with('error','Delete fail.' .$exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Slider::where('room_id',$id)->delete();
            DB::commit();

            return response()->json([
                'success' => 'Delete successful.'
            ]);

//            return redirect()->route('category.index')->with('seccess','Delete successful.');
        }catch (\Exception $exception){
            DB::rollBack();

            return response()->json([
                'error' => 'Delete fail.'
            ]);
//            return redirect()->route('category.index')->with('error','Delete fail.' .$exception->getMessage());
        }
    }
}
