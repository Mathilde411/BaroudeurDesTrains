<?php

namespace App\Game;

use App\Models\User;

class PlayerState
{
    private User $user;
    private string $color;
    private array $rides = [];
    private array $hand = [];
    private array $destinations = [];

    public function __construct(User $user, string $color)
    {
        $this->user = $user;
        $this->color = $color;
    }

    public function __serialize(): array
    {
        return [
            'user' => $this->user->id,
            'color' => $this->color,
            'rides' => $this->rides,
            'hand' => $this->hand,
            'destinations' => $this->destinations
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->user = User::find($data['user']);
        $this->color = $data['color'];
        $this->rides = $data['rides'];
        $this->hand = $data['hand'];
        $this->destinations = $data['destinations'];
    }

}
