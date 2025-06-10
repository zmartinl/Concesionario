<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Insert brands of cars.
        DB::table('brands')->insert([
            ['name' => 'Toyota'],
            ['name' => 'Ford'],
            ['name' => 'Honda'],
            ['name' => 'Chevrolet'],
            ['name' => 'Nissan'],
            ['name' => 'BMW'],
            ['name' => 'Mercedes-Benz'],
            ['name' => 'Volkswagen'],
            ['name' => 'Audi'],
            ['name' => 'Hyundai'],
            ['name' => 'Kia'],
            ['name' => 'Peugeot'],
            ['name' => 'Renault'],
            ['name' => 'Fiat'],
            ['name' => 'Mazda'],
        ]);

        // Insert colors of cars.
        DB::table('colors')->insert([
            ['name' => 'Rojo', 'hex' => '#FF0000'],
            ['name' => 'Azul', 'hex' => '#0000FF'],
            ['name' => 'Verde', 'hex' => '#008000'],
            ['name' => 'Negro', 'hex' => '#000000'],
            ['name' => 'Blanco', 'hex' => '#FFFFFF'],
            ['name' => 'Gris', 'hex' => '#808080'],
            ['name' => 'Plateado', 'hex' => '#C0C0C0'],
            ['name' => 'Amarillo', 'hex' => '#FFFF00'],
            ['name' => 'Naranja', 'hex' => '#FFA500'],
            ['name' => 'Marrón', 'hex' => '#A52A2A'],
            ['name' => 'Morado', 'hex' => '#800080'],
            ['name' => 'Rosa', 'hex' => '#FFC0CB'],
            ['name' => 'Dorado', 'hex' => '#FFD700'],
            ['name' => 'Beige', 'hex' => '#F5F5DC'],
            ['name' => 'Turquesa', 'hex' => '#40E0D0'],
        ]);

        // Insert types of cars.
        DB::table('types')->insert([
            ['name' => 'Sedán'],
            ['name' => 'Hatchback'],
            ['name' => 'SUV'],
            ['name' => 'Camioneta'],
            ['name' => 'Coupé'],
            ['name' => 'Convertible'],
            ['name' => 'Roadster'],
            ['name' => 'Minivan'],
            ['name' => 'Pickup'],
            ['name' => 'Deportivo'],
            ['name' => 'Furgoneta'],
            ['name' => 'Limusina'],
            ['name' => 'Monovolumen'],
            ['name' => 'Todoterreno'],
            ['name' => 'Wagon'],
        ]);
        
    }

    public function down(): void
    {
        // Delete data from table brands.
        DB::table('brands')->whereIn('name', [
            'Toyota', 'Ford', 'Honda', 'Chevrolet', 'Nissan', 'BMW', 
            'Mercedes-Benz', 'Volkswagen', 'Audi', 'Hyundai', 'Kia', 
            'Peugeot', 'Renault', 'Fiat', 'Mazda'
        ])->delete();

        // Delete data from table colors.
        DB::table('colors')->whereIn('name', [
            'Rojo', 'Azul', 'Verde', 'Negro', 'Blanco', 'Gris', 'Plateado',
            'Amarillo', 'Naranja', 'Marrón', 'Morado', 'Rosa', 'Dorado', 
            'Beige', 'Turquesa'
        ])->delete();

        // Delete data from table types.
        DB::table('types')->whereIn('name', [
            'Sedán', 'Hatchback', 'SUV', 'Camioneta', 'Coupé', 'Convertible', 
            'Roadster', 'Minivan', 'Pickup', 'Deportivo', 'Furgoneta', 
            'Limusina', 'Monovolumen', 'Todoterreno', 'Wagon'
        ])->delete();
        
    }
};
