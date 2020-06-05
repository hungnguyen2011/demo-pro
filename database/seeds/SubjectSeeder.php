<?php

use Illuminate\Database\Seeder;
// use App\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'subject_name' => 'Toán',
            'image' => 'https://storage.googleapis.com/hoctot-edu.appspot.com/images/791254683-1584709267721-778086620-1584243808089-icon_toan.jpeg',
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Ngữ văn',
            'image' => 'https://storage.googleapis.com/hoctot-edu.appspot.com/images/891827912-1584709252804-642037015-1584242755972-icon_van.jpeg',
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Ngoại ngữ',
            'image' => 'https://storage.googleapis.com/hoctot-edu.appspot.com/images/567915675-1584709282667-471067784-1584243049618-icon_anh.jpeg',
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Hóa học',
            'image' => 'https://storage.googleapis.com/hoctot-edu.appspot.com/images/730086426-1584334980002-icon_hoa.png',
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Vật lý',
            'image' => 'https://storage.googleapis.com/hoctot-edu.appspot.com/images/390800985-1584334943272-screenshot2020-03-15at11.01.23.png',
        ]);
    }
}
