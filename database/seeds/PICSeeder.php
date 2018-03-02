<?php

use Illuminate\Database\Seeder;

class PICSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = PICSeeder::getData();
        foreach($users as $user){
            \App\Model\PICModel::create([
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => $user['name'],
                'initial_name' => $user['initial_name'],
                'user_id' => $user['user_id'],
                'type' => $user['type']
            ]);
        }

    }

    public static function getData() {
        //sementara user sid yang dipakai ic_mas_user HO1 s/d HO10
        return [
            ['name' => 'Cipto Jati K',      'initial_name' => 'CJ', 'user_id' => '77844f80-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER'], //HO1
            ['name' => 'Deni Sahrudin',     'initial_name' => 'DS', 'user_id' => '77845822-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER'], //HO2
            ['name' => 'Feldy Yusuf',       'initial_name' => 'FY', 'user_id' => '77845eee-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER'], //HO3
            ['name' => 'Idi Sunardi',       'initial_name' => 'IS', 'user_id' => '778465ba-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER'], //HO4
            ['name' => 'Martinus Adi H',    'initial_name' => 'MR', 'user_id' => '77846c72-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER'], //HO5
            ['name' => 'Rangga Eka P',      'initial_name' => 'RE', 'user_id' => '77847348-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER'], //HO6
            ['name' => 'Rio Munas ',        'initial_name' => 'RM', 'user_id' => '77847a0a-e039-11e1-8994-002488c4036f', 'type' => 'PROGRAMMER']  //HO7
        ];
    }
}
