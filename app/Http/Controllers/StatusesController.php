<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'content' => 'required|max:140'
      ]);

      Auth::user()->statuses()->create([
        'content' => $request->content
      ]);

      return redirect()->back();
    }

    public function destroy(Status $status)
    {
      $this->authorize('destroy', $status);
      $status->delete();

      session()->flash('success', '动态已删除~');
      return redirect()->back();
    }

}
