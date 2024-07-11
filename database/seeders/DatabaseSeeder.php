<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('tasks')->delete();
        DB::table('projects')->delete();

        \App\Models\Project::create(['id' => 1, 'title' => 'Not Start']);
        \App\Models\Project::create(['id' => 2, 'title' => 'In Proccess']);
        \App\Models\Project::create(['id' => 3, 'title' => 'Pending']);
        \App\Models\Project::create(['id' => 4, 'title' => 'Done']);

        \App\Models\Task::create([
            'id' => 1,
            'project_id' => 1,
            'title' => 'Creating a new Portfolio on Dribble',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'date_end' => Carbon::createFromFormat('d M, Y', '08 Aug, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'id' => 2,
            'project_id' => 1,
            'title' => 'Singapore Team Meet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'date_end' => Carbon::createFromFormat('d M, Y', '09 Aug, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'id' => 3,
            'project_id' => 2,
            'title' => 'Plan a trip to another country',
            'description' => '',
            'date_end' => Carbon::createFromFormat('d M, Y', '10 Sep, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'id' => 4,
            'project_id' => 3,
            'title' => 'Dinner with Kelly Young',
            'description' => '',
            'date_end' => Carbon::createFromFormat('d M, Y', '08 Aug, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'id' => 5,
            'project_id' => 3,
            'title' => 'Launch New SEO Wordpress Theme',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'date_end' => Carbon::createFromFormat('d M, Y', '09 Aug, 2024')->format('Y-m-d H:i:s')
        ]);
    }
}
