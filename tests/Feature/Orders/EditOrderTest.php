<?php

namespace Tests\Feature\Orders;

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditOrderTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function aGuestCantEditOrders()
    {
        $order = factory(Order::class)->create();

        $this->get(route('order.edit', compact('order')))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function aBuyerCanEditYourOrders()
    {
        $buyerRole = Role::create(['name' => 'Buyer']);
        $buyerUser = factory(User::class)->create()->assignRole($buyerRole);
        $this->actingAs($buyerUser);

        $order = factory(Order::class)->create([
            'user_id' => $buyerUser
        ]);

        $this->get(route('order.edit', compact('order')))
            ->assertStatus(200)
            ->assertSee($order->payer_name)
            ->assertSee($order->payer_email)
            ->assertSee($order->document_number)
            ->assertSee($order->payer_phone)
            ->assertSee($order->payer_address)
            ->assertSee($order->payer_city)
            ->assertSee($order->payer_state)
            ->assertSee($order->payer_postal);
    }

    /**
     * @test
     */
    public function aBuyerCantEditOrdersFromOtherCustomers()
    {
        $buyerRole = Role::create(['name' => 'Buyer']);
        $buyerUser = factory(User::class)->create()->assignRole($buyerRole);
        $this->actingAs($buyerUser);

        $order = factory(Order::class)->create();

        $this->assertNotEquals($buyerUser->id, $order->user_id);
        $this->get(route('order.show', compact('order')))
            ->assertStatus(403);
    }
}