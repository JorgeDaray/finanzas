<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Transaccion;


class TransaccionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_consultar_transacciones()
    {
        // Simula el inicio de sesión del usuario X
        $user = User::factory()->create();  // Asegúrate de tener un factory para User
        $this->actingAs($user);

        // Realiza una petición GET a la ruta 'transacciones.index'
        $response = $this->get(route('transacciones.index'));

        // Asegura que el código de respuesta es 200 (OK)
        $response->assertStatus(200);

        // Asegura que el texto "Lista de Transacciones" esté presente en la respuesta
        $response->assertSee('Lista de Transacciones');
    }

    public function test_crear_transaccion()
    {
        // Simula el inicio de sesión del usuario X
        $user = User::factory()->create();
        $this->actingAs($user);

        // Datos válidos para crear una transacción
        $data = [
            'usuario_id' => $user->id,
            'categoria_id' => 1,  // Asegúrate de tener al menos una categoría en la DB
            'tipo' => 'ingreso',
            'monto' => 100.50,
            'descripcion' => 'Pago por servicios',
            'fecha' => '2025-05-12',
        ];

        // Realiza la petición POST para crear una transacción
        $response = $this->post(route('transacciones.store'), $data);

        // Asegura que la transacción se haya guardado en la base de datos
        $this->assertDatabaseHas('transacciones', [
            'monto' => 100.50,
            'descripcion' => 'Pago por servicios',
        ]);

        // Asegura que el redireccionamiento ocurra correctamente
        $response->assertRedirect(route('transacciones.index'));
    }

    public function test_validacion_creacion_transaccion_incorrecta()
    {
        // Simula el inicio de sesión del usuario X
        $user = User::factory()->create();
        $this->actingAs($user);

        // Datos inválidos para crear una transacción (falta el monto)
        $data = [
            'usuario_id' => $user->id,
            'categoria_id' => 1,
            'tipo' => 'ingreso',
            'descripcion' => 'Pago sin monto',
            'fecha' => '2025-05-12',
        ];

        // Realiza la petición POST para crear una transacción
        $response = $this->post(route('transacciones.store'), $data);

        // Asegura que la validación falle y se muestre el error
        $response->assertSessionHasErrors('monto');
    }

    public function test_eliminar_transaccion()
    {
        // Simula el inicio de sesión del usuario X
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crea una transacción para probar su eliminación
        $transaccion = Transaccion::factory()->create(['usuario_id' => $user->id]);

        // Realiza la petición DELETE para eliminar la transacción
        $response = $this->delete(route('transacciones.destroy', $transaccion->id));

        // Asegura que la transacción ya no existe en la base de datos
        $this->assertDatabaseMissing('transacciones', [
            'id' => $transaccion->id,
        ]);

        // Asegura que el redireccionamiento ocurra correctamente
        $response->assertRedirect(route('transacciones.index'));
    }




}
