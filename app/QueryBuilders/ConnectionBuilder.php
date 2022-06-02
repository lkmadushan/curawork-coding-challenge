<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ConnectionBuilder extends Builder
{
    public function whereRequestedToUser($userKey): self
    {
        return $this->where(
            fn (Builder $builder) => $builder
                ->where('requested_to_user_id', $userKey)
                ->whereNull('connected_at')
        );
    }

    public function whereRequestedByUser($userKey): self
    {
        return $this->where(
            fn (Builder $builder) => $builder
                ->where('requested_by_user_id', $userKey)
                ->whereNull('connected_at')
        );
    }

    public function whereConnectedToUser($userKey): self
    {
        return $this->where(
            fn (Builder $builder) => $builder
                ->where('requested_to_user_id', $userKey)
                ->whereNotNull('connected_at')
        );
    }

    public function whereConnectedByUser($userKey): self
    {
        return $this->where(
            fn (Builder $builder) => $builder
                ->where('requested_by_user_id', $userKey)
                ->whereNotNull('connected_at')
        );
    }
}
