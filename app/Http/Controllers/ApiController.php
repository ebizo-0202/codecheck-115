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
        $query = Project::query();
        $projects = $query->orderBy('id', 'desc')->paginate(10);
        $response = array();

        $response["status"] = "OK";
        $response["message"] = "No problem";

   //     return Response::json($response);
        return view('users.index')->with('users', $users);
    }
}
