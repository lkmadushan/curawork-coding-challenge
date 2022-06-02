<?php

namespace App\QueryBuilders;

use App\Models\Connection;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function whereNotRequestedToUser($userKey): self
    {
        return $this->whereNot->whereRequestedToUser($userKey);
    }

    public function whereNotRequestedByUser($userKey): self
    {
        return $this->whereNot->whereRequestedByUser($userKey);
    }

    public function whereRequestedToUser($userKey): self
    {
        return $this->whereIn(
            'id',
            Connection::query()
                ->select('requested_by_user_id')
                ->whereRequestedToUser($userKey)
        );
    }

    public function whereRequestedByUser($userKey): self
    {
        return $this->whereIn(
            'id',
            Connection::query()
                ->select('requested_to_user_id')
                ->whereRequestedByUser($userKey)
        );
    }

    public function whereConnectedToUser($userKey): self
    {
        return $this->whereIn(
            'id',
            Connection::query()
                ->select('requested_by_user_id')
                ->whereConnectedToUser($userKey)
        );
    }

    public function whereConnectedByUser($userKey): self
    {
        return $this->whereIn(
            'id',
            Connection::query()
                ->select('requested_to_user_id')
                ->whereConnectedByUser($userKey)
        );
    }

    public function whereHasAcceptedConnectionsForUser($userKey)
    {
        return $this->where(
            fn (self $builder) => $builder
                ->whereConnectedToUser($userKey)
                ->orWhere->whereConnectedByUser($userKey)
        );
    }

    public function whereHasSuggestedConnectionsForUser($userKey)
    {
        return $this->where(
            fn (self $builder) => $builder
                ->whereKeyNot($userKey)
                ->whereNotRequestedToUser($userKey)
                ->whereNotRequestedByUser($userKey)
        );
    }
}
