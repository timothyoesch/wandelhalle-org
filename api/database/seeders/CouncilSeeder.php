<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CouncilSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('councils')->delete();

        \DB::table('councils')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => '{"de": "Nationalrat", "fr": "Conseil national", "it": "Consiglio nazionale", "de_CH": "Nationalrat"}',
                'abbreviation' => 'NR_CH',
                'type' => 'national',
                'created_at' => '2026-03-23 20:36:33',
                'updated_at' => '2026-03-23 21:02:24',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '{"de": "Ständerat", "fr": "Conseil des États", "it": "Consiglio degli Stati", "de_CH": "Ständerat"}',
                'abbreviation' => 'SR_CH',
                'type' => 'national',
                'created_at' => '2026-03-23 20:39:09',
                'updated_at' => '2026-03-23 21:02:28',
            ),
        ));


    }
}
