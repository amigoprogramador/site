<?php

use Backend\Models\User;
use Renatio\Support\Models\TicketType;

$faker->locale('pl_PL');

$users = User::all();
$types = TicketType::all();

$factory('Renatio\Support\Models\Ticket', [
    'user'       => $faker->randomElement($users->lists('id')),
    'type'       => $faker->randomElement($types->lists('id')),
    'subject'    => $faker->sentence,
    'content'    => $faker->text,
    'is_closed'  => $faker->boolean(),
    'created_at' => $faker->dateTimeThisMonth()
]);

$factory('Renatio\Support\Models\TicketMessage', [
    'user'       => $faker->randomElement($users->lists('id')),
    'ticket'     => 'factory:' . 'Renatio\Support\Models\Ticket',
    'reply'      => $faker->text,
    'created_at' => $faker->dateTimeThisMonth()
]);