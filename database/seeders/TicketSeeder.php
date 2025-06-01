<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Destination;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'ticket_name' => 'Tiket Masuk Reguler - Weekday',
            'price' => 55000,
            'destination_id' => 1,
        ]);

        Ticket::create([
            'ticket_name' => 'Tiket Masuk Reguler - Weekend',
            'price' => 85000,
            'destination_id' => 2,
        ]);
    }
}
