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
        DB::table('users')->delete();
        DB::table('tasks')->delete();
        DB::table('projects')->delete();

        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        \App\Models\Project::create(['id' => 1, 'title' => 'Not Start']);
        \App\Models\Project::create(['id' => 2, 'title' => 'In Proccess']);
        \App\Models\Project::create(['id' => 3, 'title' => 'Pending']);
        \App\Models\Project::create(['id' => 4, 'title' => 'Done']);

        \App\Models\Task::create([
            'project_id' => 1,
            'title' => 'Creating a new Portfolio on Dribble',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'tags' => 'Designing, Coding',
            'date_start' => Carbon::createFromFormat('d M, Y', '02 Aug, 2024')->format('Y-m-d H:i:s'),
            'date_end' => Carbon::createFromFormat('d M, Y', '08 Aug, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'project_id' => 1,
            'title' => 'Singapore Team Meet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'tags' => 'Meeting',
            'date_start' => Carbon::createFromFormat('d M, Y', '01 Jul, 2024')->format('Y-m-d H:i:s'),
            'date_end' => Carbon::createFromFormat('d M, Y', '09 Aug, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'project_id' => 2,
            'title' => 'Plan a trip to another country',
            'description' => '',
            'tags' => 'Planning',
            'date_start' => Carbon::createFromFormat('d M, Y', '10 Aug, 2024')->format('Y-m-d H:i:s'),
            'date_end' => Carbon::createFromFormat('d M, Y', '10 Sep, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'project_id' => 3,
            'title' => 'Dinner with Kelly Young',
            'description' => '',
            'tags' => 'Meeting',
            'date_start' => Carbon::createFromFormat('d M, Y', '08 Jun, 2024')->format('Y-m-d H:i:s'),
            'date_end' => Carbon::createFromFormat('d M, Y', '28 Jun, 2024')->format('Y-m-d H:i:s')
        ]);

        \App\Models\Task::create([
            'project_id' => 3,
            'title' => 'Launch New SEO Wordpress Theme',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'date_start' => Carbon::createFromFormat('d M, Y', '09 May, 2024')->format('Y-m-d H:i:s'),
            'date_end' => Carbon::createFromFormat('d M, Y', '12 Jul, 2024')->format('Y-m-d H:i:s')
        ]);
    }
}
