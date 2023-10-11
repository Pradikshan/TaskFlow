<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = new Task;

            $user_id = Auth::id();

            $task->user_id = $user_id;


            $task->title = $request->title;
            $task->category = $request->category;
            $task->description = $request->description;
            $task->priority = $request->priority;
            $task->location = $request->location;
            $task->due_date = $request->due_date;
 
            $task->save();


            $subtasks = $request->input('subtasks');
            if (!empty($subtasks)) {
                foreach ($subtasks as $subtask) {
                    if (!empty($subtask)) {
                        $task->subtasks()->create([
                            'subtask' => $subtask,
                        ]);
                    }
                }
            }
            

            return redirect('/create_task')->with('status', 'success');
        }   catch (Exception $e) {
            return redirect('/create_task')->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $tasks = Task::with('subtasks')
        ->where('status', 'ACTIVE')
        ->get();

        // Filter tasks where not all subtasks are complete (less than 100% completion)
        $incompleteTasks = $tasks->filter(function ($task) {
            return $task->subtasks->count() == 0 || // Handle tasks with no subtasks
                $task->subtasks->where('status', true)->count() < $task->subtasks->count();
        });
    
        return view('index', compact('incompleteTasks'));
    }


    public function taskLog(Task $task)
    {
        // Get all tasks with their associated subtasks
        $tasks = Task::with('subtasks')
        ->where('status', 'ACTIVE')
        ->get();

        // Filter tasks where all subtasks are complete (100% completion)
        $completedTasks = $tasks->filter(function ($task) {
            return $task->subtasks->count() > 0 &&
                $task->subtasks->where('status', true)->count() == $task->subtasks->count();
        });

        return view('log', compact('completedTasks'));
    }


    public function showTaskDetails($id)
    {
        $task = Task::with('subtasks')->find($id);
    
        if (!$task) {
            return redirect()->route('index')->with('error', 'Task not found');
        }
    
        $subtasks = $task->subtasks;

        $totalSubtasks = $task->subtasks->count();
        $completedSubtasks = $task->subtasks->where('status', true)->count();

        // Create an associative array to store the counts for the current task
        $taskSubtasksCounts = [
            'totalSubtasks' => $totalSubtasks,
            'completedSubtasks' => $completedSubtasks,
        ];
    
       
        // dd($task);
        // dd($subtasks);
    
        return view('task_detail', compact('task', 'subtasks', 'taskSubtasksCounts'));
    }
    

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task_edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            // Update the main task details
            $task->update([
                'title' => $request->title,
                'category' => $request->category,
                'description' => $request->description,
                'priority' => $request->priority,
                'location' => $request->location,
                'due_date' => $request->due_date,
            ]);
    
            // Update existing subtasks
            $subtasksData = $request->input('subtasks', []);
            $subtaskIds = $request->input('subtask_ids', []);
    
            foreach ($subtasksData as $index => $subtaskText) {
                $subtaskId = $subtaskIds[$index] ?? null; // Get the corresponding subtask ID
    
                if ($subtaskId) {
                    // Update the existing subtask
                    $subtask = Subtask::find($subtaskId);
    
                    if ($subtask) {
                        $subtask->update(['subtask' => $subtaskText]);
                    }
                } else {
                    // Create a new subtask
                    Subtask::create(['task_id' => $task->id, 'subtask' => $subtaskText, 'status' => 0]);
                }
            }
    
            return redirect()->route('task_detail', ['id' => $task->id])->with('status', 'updated');
        } catch (Exception $e) {
            return redirect()->route('task_detail', ['id' => $task->id])->with('status', 'error');
        }
    }
    




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }


    public function updateSubtasks(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('index')->with('error', 'Task not found');
        }

        $subtaskIds = $request->input('subtask_checkbox', []);

        // Get all subtasks for the task
        $subtasks = $task->subtasks;

        // Update subtask statuses based on checkbox values
        foreach ($subtasks as $subtask) {
            $subtask->status = in_array($subtask->id, $subtaskIds);
            $subtask->save();
        }

        return redirect()->route('task_detail', ['id' => $task->id])->with('success', 'Subtask status updated');
    }

    public function deactivateTask(Request $request, $id)
    {
            try {
            $task = Task::find($id);

            if ($task) {
                $task->status = 'INACTIVE';
                $task->save();
            }

            return redirect('/index')->with('status', 'deleted');

        } catch (Exception $e) {
            return redirect('/index')->with('status', 'error');  
        }
    }

    

}
