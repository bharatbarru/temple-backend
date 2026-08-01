<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Spatie\Permission\Models\Permission;

class PermissionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_permission()
    {
        $permission = factory(Permission::class)->create();

        $this->response = $this->json(
            'POST',
            '/api/permission',
            $permission
        );

        $this->assertApiResponse($permission);
    }

    /**
     * @test
     */
    public function test_read_permission()
    {
        $permission = Permission::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/permission/' . $permission->id
        );

        $this->assertApiResponse($permission->toArray());
    }

    /**
     * @test
     */
    public function test_update_permission()
    {
        $permission = Permission::factory()->create();
        $editedPermission = Permission::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/permission/' . $permission->id,
            $editedPermission
        );

        $this->assertApiResponse($editedPermission);
    }

    /**
     * @test
     */
    public function test_delete_permission()
    {
        $permission = Permission::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/permission/' . $permission->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/permission/' . $permission->id
        );

        $this->response->assertStatus(404);
    }
}
