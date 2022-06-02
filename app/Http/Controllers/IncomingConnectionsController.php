<?php

namespace App\Http\Controllers;

use App\Models\User;

class IncomingConnectionsController extends Controller
{
    public function index()
    {
        $content = view('components.request', [
            'mode' => 'received',
            'users' => User::query()->whereRequestedToUser(auth()->id())->get(),
        ])->render();

        return response()->json(compact('content'));
    }

    public function store()
    {
        request()->validate(['user_id' => 'required']);

        $user = User::query()->findOrFail(request()->input('user_id'));

        auth()->user()->incomingConnections()
            ->syncWithoutDetaching([$user->getKey() => ['connected_at' => now()]]);

        return response()->json();
    }
}
