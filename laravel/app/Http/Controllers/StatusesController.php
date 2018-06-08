<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    //以后要用到用户登陆的 都需要加这窜代码。
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

        $this->validate($request,[
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);

        session()->flash('success','发布成功！');
        return redirect()->back();
    }

    public function destroy(Status $status){

        $this->authorize('destroy',$status);
        $status->delete();
        session()->flash('success', '成功删微博！');
        return redirect()->back();
    }
}
