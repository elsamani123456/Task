<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Session;
class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('id', 'asc')->paginate(10);
        return view('task/index', compact('tasks'));
    }

    public function create()
    {
        return view('task/create');
    }

    public function store(Request $request)
    {
        //
        $create_task = $this->validate(request(), [
            'title'         => 'required|string|max:255|min:3',
            'description'   => 'required|string|max:1000|min:20',
            'add_date'      => 'required|date',
            ], [] ,[
            'title'         => 'Title',
            'description'   => 'Description',
            'add_date'      => 'Add Date',
            ]);
        Task::updateOrcreate($create_task);
        //session::flash('success', 'Created Task Successfully');
        return back();
    }

    public function edit($id)
    {
        //
        $task = Task::Find($id);
        return view('task/edit')->withTask($task);
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate(request(), [
            'title'         => 'required|string|max:255|min:3',
            'description'   => 'required|string|max:1000|min:20',
            'add_date'      => 'required|date',
            ], [] ,[
            'title'         => 'Title',
            'description'   => 'Description',
            'add_date'      => 'Add Date',
            ]);

        $task = Task::Find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->add_date = $request->add_date;
        $task->save();
        //session::flash('success', 'Created Task Successfully');
        return redirect('task');
    }

    public function destroy($id)
    {
        $delete = Task::Find($id);
        $delete->delete();
        return back();
    }

    public function task_trashed() {
        $trashed = Task::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        return view('task/trashed', compact('trashed'));
    }
    
    public function forcedelete($id)
    {
        $delete = Task::withTrashed()->where('id', $id)->first();
        $delete->forceDelete();
        return back();
    }

    public function restore($id)
    {
        $delete = Task::withTrashed()->where('id', $id)->first();
        $delete->restore();
        return redirect('task');
    }
}
