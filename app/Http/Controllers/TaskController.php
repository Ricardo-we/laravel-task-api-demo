<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

function validate($data, $required=null, $min=null, $max=null, $contains=null, $errorMessage=''){
    $data_len = strlen($data);
    if($required && $max != null && $data_len > $max) throw new \Exception($errorMessage ?:'Data exceeds max length');
    if($required && $min != null && $data_len < $min) throw new \Exception($errorMessage ?: 'Data is less then minimum length');
    if(!$data && $required) throw new \Exception($errorMessage ?: 'Field required');
    if($contains != null && str_contains($data, $contains)) throw new \Exception($errorMessage ?: 'Field required ' . $contains);
}

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return $tasks;        
    }

    public function store(Request $request)
    {

        try{
            validate($request->title, true, 2, 50);
            validate($request->description, true, 0, 255);
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->save();
            return $task;
        } catch(\Exception $error){
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function show($id)
    {
        $task = Task::find($id);
        return $task;
    }

    public function update(Request $request, $id)
    {
        try{
            validate($request->title, true, 1, 50);
            validate($request->description, true, 0, 255);
            $task = Task::findOrFail($id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->save();
            return $task;
        } catch(\Exception $error){
            return response()->json(['message' => $error->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Task::destroy($id);
            return response()->json(['message' => 'success']);
        } catch(\Exception $error){
            return response()->json(['message' => 'failed']);
        }
    }
} 