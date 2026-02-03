<?php

use App\\Models\\Pengguna;

test('confirm password screen can be rendered', function () {
    $user = Pengguna::factory()->create();

    $response = $this->actingAs($user)->get(route('password.confirm'));

    $response->assertOk();
});
