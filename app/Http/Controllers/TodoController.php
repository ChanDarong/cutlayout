<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Todo;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user_id = Auth::user()->id;
        $todo = Todo::where([
            ['user_id',$user_id],
            ['deleted_at', null]
        ])->get();
        // return $todo;
        // return $user = User::with('todos')->get();
        // return $todos;
        return view('todo.index', ['todos'=>$todo]);
    }

    public function create(){
        return view('todo.create');
    }
    public function store(Request $req){
        $data = $req->validate([
            'name' => 'required',
            'due_date' => '',
            'description' => '',
            'start_date' => '',
            'end_date' => '',
        ]);
        $user_id = Auth::user()->id;
        $user_id_array = ['user_id'=>$user_id];
        // $data = $req->only([
        //     'name',
        //     'due_date',
        //     'description',
        //     'start_date',
        //     'end_date',
        // ]);

        $datas = array_merge(
            $data,
            $user_id_array
        );

        // return $todos;
        $todos = Todo::create($datas);
        Alert::success('Success', 'One task has beed create successfully.')->autoClose(3000);
        return redirect()->route('todo.index');
    }

    public function show(Todo $todo){
        // $data = Todo::where('id', $todo)->get();
        return view('todo.view', compact('todo'));
    }

    public function edit(Todo $todo){
        return view('todo.edit', compact('todo'));
    }

    public function update(Request $req, Todo $todo){
        $data = $req->validate([
            'name' => 'required',
            'due_date' => '',
            'description' => '',
            'start_date' => '',
            'end_date' => '',
        ]);
        $user_id = $todo->user_id;
        $user_id_array = ['user_id'=>$user_id];
        // return $user_id_array;

        $datas = array_merge(
            $data,
            $user_id_array
        );
        $id = $todo->id;
        // return $id;
        $todos = Todo::where('id',$id)->update($datas);
        Alert::success('Success', 'One task has beed update successfully.')->autoClose(3000);
        return redirect()->route('todo.index');
    }

    public function destroy(Todo $todo){
        $id =$todo->id;
        Todo::where('id', $id)->delete();

        return redirect()->back();
    }

    public function trash(){
        $user_id = Auth::user()->id;
        $todos = Todo::where('user_id', $user_id)->onlyTrashed()->get();
        // return $todos;
        return view('todo.trash', compact('todos'));
    }

    public function restore($todo){
        Todo::onlyTrashed()->where('id', $todo)->restore();
        return redirect()->back();
    }

    public function forceDelete($todo){
        Todo::where('id', $todo)->forceDelete();
        return redirect()->back();
    }

    public function filter(Request $request){
        $request->only([
            'name',
            'from',
            'to',
            'status'
        ]);
        $user_id = Auth::user()->id;

        // convert to dateTime
        $date_from = Carbon::parse($request->from)->toDateTimeString();
        $date_to = Carbon::parse($request->to)->toDateTimeString();

        if($request->status == 'all'){
            if(!isEmpty($request->name) && !isEmpty($request->from) && !isEmpty($request->to)){
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->get();
            }
            if (isEmpty($request->name)) {
                $todos = Todo::where('user_id', $user_id)
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->get();
            }
            if (isEmpty($request->from) && isEmpty($request->to)) {
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->get();
            }
        }
        else{
            if(!isEmpty($request->name) && !isEmpty($request->from) && !isEmpty($request->to)){
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->where('is_completed', $request->status)
                            ->get();
            }
            if (isEmpty($request->name)) {
                $todos = Todo::where('user_id', $user_id)
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->where('is_completed', $request->status)
                            ->get();
            }
            if (isEmpty($request->from) && isEmpty($request->to)) {
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->where('is_completed', $request->status)
                            ->get();
            }
        }
        return view('todo.index', compact('todos'));
    }

    public function filterTrash(Request $request){
        $request->only([
            'name',
            'from',
            'to',
            'status'
        ]);
        $user_id = Auth::user()->id;

        // convert to dateTime
        $date_from = Carbon::parse($request->from)->toDateTimeString();
        $date_to = Carbon::parse($request->to)->toDateTimeString();

        if($request->status == 'all'){
            if(!isEmpty($request->name) && !isEmpty($request->from) && !isEmpty($request->to)){
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->onlyTrashed()
                            ->get();
            }
            if (isEmpty($request->name)) {
                $todos = Todo::where('user_id', $user_id)
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->onlyTrashed()
                            ->get();
            }
            if (isEmpty($request->from) && isEmpty($request->to)) {
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->onlyTrashed()
                            ->get();
            }
        }
        else{
            if(!isEmpty($request->name) && !isEmpty($request->from) && !isEmpty($request->to)){
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->where('is_completed', $request->status)
                            ->onlyTrashed()
                            ->get();
            }
            if (isEmpty($request->name)) {
                $todos = Todo::where('user_id', $user_id)
                            ->whereBetween('created_at', [$date_from, $date_to])
                            ->where('is_completed', $request->status)
                            ->onlyTrashed()
                            ->get();
            }
            if (isEmpty($request->from) && isEmpty($request->to)) {
                $todos = Todo::where('user_id', $user_id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->where('is_completed', $request->status)
                            ->onlyTrashed()
                            ->get();
            }
        }
        return view('todo.trash', compact('todos'));
    }

    public function complete(Request $request, $todo){
        $request->only('status');
        // return $request->status;
        if($request->status == 'completed'){
            $is_completed = ['is_completed' => '0'];
            // dd($is_completed);
            Todo::where('id', $todo)->update($is_completed);
            toast('Status has been updated','success');
            return redirect()->back();
        }
        if($request->status == 'not_completed'){
            // $status = 1;
            // return $status;
            $is_completed = ['is_completed' => '1'];
            // dd($is_completed);
            Todo::where('id', $todo)->update($is_completed);
            toast('Status has been updated','success');
            return redirect()->back();
        }

    }

}
