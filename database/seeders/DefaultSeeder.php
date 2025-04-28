<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ecoId = DB::table('room_types')->insertGetId([
            'name' => 'Эконом',
            'description' => 'Уютный номер с базовыми удобствами для комфортного отдыха. Идеальный выбор для тех, кто ценит простоту и разумный бюджет.',
        ]);

        $famId = DB::table('room_types')->insertGetId([
            'name' => 'Семейный',
            'description' => 'Просторный номер, созданный для отдыха всей семьи. Предусмотрены дополнительные спальные места и всё необходимое для вашего удобства.',
        ]);

        $comId = DB::table('room_types')->insertGetId([
            'name' => 'Комфорт',
            'description' => 'Стильный и светлый номер с повышенным уровнем удобства. Комфортная атмосфера для приятного отдыха или спокойной работы.',
        ]);

        $busId = DB::table('room_types')->insertGetId([
            'name' => 'Бизнес',
            'description' => 'Функциональный номер для деловых поездок: рабочее место, высокоскоростной интернет и спокойная обстановка для продуктивности и отдыха.',
        ]);

        // Эконом
        DB::table('rooms')->insert([
            'room_type_id' => $ecoId,
            'capacity' => 1,
            'price' => 1200,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $ecoId,
            'capacity' => 2,
            'price' => 1850,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $ecoId,
            'capacity' => 2,
            'price' => 1850,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $ecoId,
            'capacity' => 2,
            'price' => 1850,
        ]);

        // Семейный
        DB::table('rooms')->insert([
            'room_type_id' => $famId,
            'capacity' => 3,
            'price' => 3000,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $famId,
            'capacity' => 3,
            'price' => 3000,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $famId,
            'capacity' => 4,
            'price' => 4000,
        ]);

        // Комфорт
        DB::table('rooms')->insert([
            'room_type_id' => $comId,
            'capacity' => 1,
            'price' => 2500,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $comId,
            'capacity' => 2,
            'price' => 5000,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $comId,
            'capacity' => 3,
            'price' => 6500,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $comId,
            'capacity' => 4,
            'price' => 10000,
        ]);

        // Бизнес
        DB::table('rooms')->insert([
            'room_type_id' => $busId,
            'capacity' => 1,
            'price' => 4000,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $busId,
            'capacity' => 2,
            'price' => 8000,
        ]);


        DB::table('rooms')->insert([
            'room_type_id' => $busId,
            'capacity' => 3,
            'price' => 11000,
        ]);

        DB::table('rooms')->insert([
            'room_type_id' => $busId,
            'capacity' => 3,
            'price' => 13000,
        ]);


    }
}
