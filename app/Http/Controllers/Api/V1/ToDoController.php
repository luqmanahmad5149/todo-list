<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ToDoCollection;
use App\Http\Resources\V1\ToDoResource;
use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
{
    /**
     * Handle new task creation.
     * @method POST
     * @route /task
     */
    public function postTask(Request $request) {
        try{
            $user_id = Auth::id();

            $toDo = ToDo::create([
                'user_id' => $user_id,
                'task' => $request->task,
                'is_complete' => false,
            ]);
        
            return response()->json(new ToDoResource($toDo), 201);
        } catch(\Exception $e) {
            throw new GeneralException($e->getMessage(), 400);
        }
    }

    /**
     * Retrieve all tasks for display.
     * @method GET
     * @route /tasks
     */
    public function getTasks() {
        return response()->json(new ToDoCollection(Auth::user()->tasks), 201);
    }

    /**
     * Update status of the task.
     * @method PUT
     * @route /task/update
     */
    public function updateStatus(Request $request) {
        try {
            $user_id = Auth::id();

            $task = ToDo::where([
                'id' => $request->task_id,
                'user_id'=> $user_id,
            ])->first();

            if($task) {
                $task->update([
                    'is_complete' => $request->is_complete
                ]);
                
                return response()->json(new ToDoResource($task), 201);
            } else {
                return response()->json([
                    'message' => 'Task not found!'
                ], 201);
            }
            
        } catch(\Exception $e) {
            throw new GeneralException($e->getMessage(), 400);
        }
    }

    /**
     * Delete task.
     * @method DELETE
     * @route /task/delete
     */
    public function deleteTask(Request $request) {
        try {
            $user_id = Auth::id();
            $message = '';
    
            $task = ToDo::where([
                'id' => $request->task_id,
                'user_id'=> $user_id,
            ])->first();
    
            if($task) {
                $task->delete();
                $message = 'Task successfully deleted!';
            } else {
                $message = 'Task not found!';
            }
    
            return response()->json([
                'message' => $message
            ], 201);
        } catch(\Exception $e) {
            throw new GeneralException($e->getMessage(), 400);
        }
    }
}
