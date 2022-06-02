<?php

namespace App\Http\Controllers;

use App\Models\User;

class OutgoingConnectionsController extends Controller
{
    public function index()
    {
        $content = view('components.request', [
            'mode' => 'sent',
            'users' => User::query()->whereRequestedByUser(auth()->id())->get(),
        ])->render();

        return response()->json(compact('content'));
    }

    public function destroy(User $user)
    {
        auth()->user()->outgoingConnections()->detach($user);

        return response()->json();
    }
}
