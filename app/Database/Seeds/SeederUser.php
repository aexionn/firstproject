<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SeederUser extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i=0; $i<=10; $i++){
            $data = [
                'title'         => $faker->word(),
                'content'       => $faker->sentence(),
                'id_kategori'   => 1,
                'id_user'       => 1,
                // 'password'   => $faker->bothify('?????#####'),
                // 'image'      => $faker->imageUrl(),
                // 'created_at' => Time::createFromTimestamp($faker->unixTime()),
                // 'updated_at' => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('diary')->insert($data);
        }

    }
}
