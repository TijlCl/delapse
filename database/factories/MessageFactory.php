<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_id' => 3,
            'to_id' => 4,
            'chat_id' => 1,
            'body' => 'Sup',
            'send_at' => Carbon::now()
        ];
    }
}
