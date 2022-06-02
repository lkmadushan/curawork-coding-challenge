<?php

namespace App\Http\Controllers;

use App\Models\User;

class SuggestedConnectionsController extends Controller
{
    public function index()
    {
        $users = User::query()->whereHasSuggestedConnectionsForUser(auth()->id())->get();

        $content = view('components.suggestion', compact('users'))->render();

        return response()->json(compact('content'));
    }

    public function store()
    {
        request()->validate(['user_id' => 'required']);

        $user = User::query()->findOrFail(request()->input('user_id'));

        auth()->user()->outgoingConnections()->attach($user);

        return response()->json();
    }
}
