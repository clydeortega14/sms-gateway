<?php

use Illuminate\Database\Seeder;
use App\LogType;

class LogTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogType::insert([
            [
                'code'              =>  'EXCEPTION_ERR',
                'description'       =>  'try catch exception'
            ],
            [
                'code'              =>  'PREFIX_ERR',
                'description'       =>  'Invalid prefix of the recipient\'s number'
            ],
            [
                'code'              =>  'TOKEN_ERR',
                'description'       =>  'Invalid access token'
            ],
            [
                'code'              =>  'STATUS_ERR',
                'description'       =>  'Credential status is inactive'
            ],
            [
                'code'              =>  'API_ERR',
                'description'       =>  'Message not sent, globe response is not 201'
            ]
        ]);
    }
}
