<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todoList = Todo::all()->toArray();
        $todoTable = view('list', compact('todoList'))->render();
        return view("index")->with(
            compact([
                'todoTable'
            ])
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Todo::create([
            'title' => $request->title, 
            'description' => $request->description, 
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);
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
        $task = Todo::getById($id)->toArray();
        $task = $task[0];
        return view("info")->with(
            compact([
                'task'
            ])
        );
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
        $task = Todo::getById($id)->toArray();
        $task = $task[0];
        return view("edit")->with(
            compact([
                'task'
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        Todo::where('id', $request->id)
            ->update([
                'title' => $request->title, 
                'description' => $request->description, 
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);
        // return redirect()->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Todo::find($request->id)->delete();
        return redirect()->action([self::class, 'index']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function done(Request $request)
    {
       
        Todo::where('id', $request->id)
        ->update([
            'status' => 1,
        ]);

        return redirect()->action([self::class, 'index']);
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        if ($search == 'Done' or $search == 'done'){
            $statusint = 1;
        }elseif ($search == 'Not' or $search == 'not'){
            $statusint = 0;
        }else{
            $statusint = $search;
        }
        // Search in the title and body columns from the posts table
        $searchs = Todo::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('status','LIKE', "%{$statusint}%" )
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search', compact('searchs'));
    }
}
