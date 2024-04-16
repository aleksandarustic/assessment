<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $rootFolder = File::create([
            "name" => "MainFolder",
            "type" => "folder",
        ]);

        $productFolder = File::create([
            "name" => "product_data",
            "type" => "folder",
            "parent_id" => $rootFolder->id,
        ]);

        File::insert([
            [
                "name" => "agreement.pdf",
                "type" => "file",
                "parent_id" => null
            ],
            [
                "name" => "cv.pdf",
                "type" => "file",
                "parent_id" => $rootFolder->id
            ],
            [
                "name" => "profileImage.png",
                "type" => "file",
                "parent_id" => $rootFolder->id
            ],
            [
                "name" => "product1.pdf",
                "type" => "file",
                "parent_id" => $productFolder->id
            ],
            [
                "name" => "product2.pdf",
                "type" => "file",
                "parent_id" => $productFolder->id
            ],
            [
                "name" => "product3.pdf",
                "type" => "file",
                "parent_id" => $productFolder->id
            ],
        ]);


    }
}
