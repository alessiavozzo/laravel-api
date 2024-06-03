<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('type', 'technologies')->paginate(6);
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function show($slug)
    {
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'response' => $project
            ]);
        } else {
            /* 404 */
            return response()->json([
                'success' => false,
                'response' => 'sorry nothing found'
            ]);
        }
    }
}
