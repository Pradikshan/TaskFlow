<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subtask;
use Illuminate\Support\Facades\DB;

class SubtaskController extends Controller
{
    public function taskAnalytics()
    {
        // Retrieve completed subtasks grouped by date
        $completedSubtasks = Subtask::where('status', 1)
            ->groupBy(DB::raw('DATE(updated_at)'))
            ->orderBy('updated_at')
            ->get([
                DB::raw('DATE(updated_at) as date'),
                DB::raw('COUNT(*) as count')
            ]);

        return view('task_analytics', compact('completedSubtasks'));
    }

}
