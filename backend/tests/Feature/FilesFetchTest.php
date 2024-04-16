<?php

namespace Feature;

use App\Models\File;
use Tests\TestCase;

/**
 * Class FilesFetchTest
 * @package Tests\Feature
 */
class FilesFetchTest extends TestCase
{
    /**
     *
     */
    public function testIndexFiles()
    {
        $count = File::count();

        $response = $this->get("/api/files");
        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                "id",
                "name",
                "type",
                "parent_id"
            ]
        ]);

        $response->assertJsonCount($count);
    }


    /**
     *
     */
    public function testShowFile()
    {
        $file = File::firstOrFail();

        $response = $this->get("/api/files/{$file->id}");
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => $file->id,
            'name' => $file->name,
            'parent_id' => $file->parent_id,
            'type' => $file->type
        ]);

        $response = $this->get("/api/files/23232323");
        $response->assertNotFound();

    }

}
