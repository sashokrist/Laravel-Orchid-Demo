<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Builder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::factory(10)->create();

         User::factory()->create([
             'name' => $faker->name,
             'email' => $faker->email,
             'password' => '1234',
             'permissions' => ''
         ]);

         Role::factory()->create([
             'slug' => 'admin',
             'name' => 'admin',
             'permissions' =>[
                 'platform.systems.attachment' => '1',
                 'platform.systems.roles' => '1',
                 'platform.systems.users' => '1',
                 'platform.product.delete' => '1',
                 'platform.products.list' => '1',
                 'platform.product.update' => '1',
                 'platform.products.create' => '1',
                 'platform.index' => '1'],
         ]);

        Role::factory()->create([
            'slug' => 'customer',
            'name' => 'customer',
            'permissions' =>[
                'platform.systems.attachment' => '0',
                'platform.systems.roles' => '0',
                'platform.systems.users' => '0',
                'platform.product.delete' => '1',
                'platform.products.list' => '1',
                'platform.product.update' => '1',
                'platform.products.create' => '1',
                'platform.index' => '1'],
        ]);

        Role::factory()->create([
            'slug' => 'quest',
            'name' => 'quest',
            'permissions' =>[
                'platform.systems.attachment' => '0',
                'platform.systems.roles' => '0',
                'platform.systems.users' => '0',
                'platform.product.delete' => '0',
                'platform.products.list' => '0',
                'platform.product.update' => '0',
                'platform.products.create' => '0',
                'platform.index' => '1'],
        ]);

    }

//    public function scopeByAccess(Builder $builder, string $permitWithoutWildcard): Builder
//    {
//        if (empty($permitWithoutWildcard)) {
//            return $builder->whereRaw('1=0');
//        }
//        return $this->scopeByAnyAccess($builder, $permitWithoutWildcard);
//    }
}
