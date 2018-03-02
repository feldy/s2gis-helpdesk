<?php

use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\App\Model\IssueHdrModel::class, 3)
            ->create()
            ->each(function ($u) {
                $u->details()->saveMany(factory(\App\Model\IssueDtlModel::class, 5)->make());
            });
    }
}
