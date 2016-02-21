<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;

class ApiController extends Controller
{
    public function index()
    {
        $projects = new Project;
        $allProjects = $projects->all();

        if(!$allProjects) {
            return response()->json([ 'error' => 404, 'message' => 'NotFound' ], 404);
        }
        return response()->json([ 'status' => 200, 'message' => 'OK', 'results' => $allProjects], 200);
       // return response()->json(200);
    }

    public function create(Request $request)
    {
        $inputs = $request->all();
        $rules = [
            'title'=>'required',
            'description'=>'required',
        ];

        $messages = [
            'title.required'=>'名前は必須です。',
            'description.required'=>'emailは必須です。',
        ];

        $validation = \Validator::make($inputs,$rules,$messages);

        if($validation->fails())
        {
            return response()->json([ 'error' => 400, 'message' => 'BadRequest' ], 400);
        }

        //$project = Project::create();
        $project = new Project;
        if (!$request->title || !$request->description){
            return response()->json([ 'error' => 400, 'message' => 'BadRequest' ], 400);
        }
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

        return response()->json([ 'error' => 200, 'message' => 'OK' ], 200);
    }
    
    public function detail($id)
    {
        $response = array();
        $project = Project::find($id);

        if (!$project) {
            return response()->json([ 'error' => 404, 'message' => 'NotFound' ], 404);
        }

        return response()->json([ 'status' => 200, 'message' => 'OK', 'results' => $project], 200);
    }
 
    public function delete($id)
    {
        $response = array();
        $project = Project::find($id);
        if (!$project) {
            return response()->json([ 'error' => 404, 'message' => 'NotFound' ], 404);
        }
        $project->delete();

        //return response()->json([ 'status' => 200, 'message' => 'OK' ], 200);
        return response()->json(200);
    }
}
