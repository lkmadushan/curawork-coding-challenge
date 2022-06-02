<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;

class AcceptedConnectionsController extends Controller
{
    public function index()
    {
        $users = User::query()->whereHasAcceptedConnectionsForUser(auth()->id())->get();

        $content = view('components.connection', compact('users'))->render();

        return response()->json(compact('content'));
    }

    public function destroy(User $user)
    {
        Connection::query()
            ->where(
                fn ($query) => $query
                    ->whereConnectedByUser(auth()->id())
                    ->whereConnectedToUser($user->getKey())
            )
            ->orWhere(
                fn ($query) => $query
                    ->whereConnectedByUser($user->getKey())
                    ->whereConnectedToUser(auth()->id())
            )
            ->delete();

        return response()->json();
    }
}
