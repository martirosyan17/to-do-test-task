<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ToDo;
class ToDoController extends Controller
{
    public function index()
    {
        $tasks = ToDo::orderBy('created_at', 'desc')->get();
        return response()->json($tasks);
    }
    public function store(Request $request)
    {
        ToDo::create(['list' => $request->task]);
    }
}
