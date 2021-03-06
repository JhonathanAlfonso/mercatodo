<?php

namespace Tests\Feature\Admin\Product;

use App\Constants\Permissions;
use App\Constants\PlatformRoles;
use App\Entities\Product;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndexProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guestCantIndexProducts()
    {
        factory(Product::class)->create();

        $response = $this->get(route('admin.products.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function buyerCantIndexProducts()
    {
        factory(Product::class)->create();
        $buyerUser = factory(User::class)->create();
        $this->actingAs($buyerUser);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function adminRoleWithPermissionCanIndexProducts()
    {
        $products = factory(Product::class, 10)->create();

        $viewProductPermission = Permission::create(['name' => Permissions::VIEW_PRODUCTS]);
        $adminRole = Role::create(['name' => PlatformRoles::ADMIN])->givePermissionTo($viewProductPermission);
        $admUser = factory(User::class)->create()->assignRole($adminRole);
        $this->actingAs($admUser);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);

        $products->each(function ($item) use ($response) {
            $response->assertSee($item->name);
            $response->assertSee($item->ean);
            $response->assertSee($item->price);
        });
    }

    /**
     * @test
     */
    public function adminRoleWithoutPermissionCantIndexProducts()
    {
        factory(Product::class, 30)->create();

        Permission::create(['name' => Permissions::VIEW_PRODUCTS]);
        $adminRole = Role::create(['name' => PlatformRoles::ADMIN]);
        $admUser = factory(User::class)->create()->assignRole($adminRole);
        $this->actingAs($admUser);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(403);
    }
}
