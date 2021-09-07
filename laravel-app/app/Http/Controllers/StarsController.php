<?php

namespace App\Http\Controllers;

use App\Models\Star;
use Illuminate\Http\Request;

class StarsController extends Controller
{
    public function index()
    {
        $stars = auth()->user()->stars();
        return view('dashboard', compact('stars'));
    }

    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'required']);
        $star = new Star();
        $star->name = $request->name;
        $star->description = $request->description;
        $star->user_id = auth()->user()->id;
        $star->save();
        return redirect('/dashboard');
    }

    public function edit(Star $star)
    {
        if (auth()->user()->id == $star->user_id) {
            return view('edit', compact('star'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, Star $star)
    {
        if(isset($_POST['delete'])){
            $star->delete();
            return redirect('/dashboard');
        } else {
            $this->validate($request, ['name' => 'required', 'description' => 'required']);
            $star->name = $request->name;
            $star->description = $request->description;
            $star->save();
            return redirect('/dashboard');
        }
    }
}
