<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ContactForm;
// ダミーデータ生成ライブラリ laravelで標準インストールされてる
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactForm>
 */
class ContactFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // fakerもバージョンが変わり書き方が関数化している
    /**
     * 
     */
    public function definition()
    {
        return [
            'your_name' => $this->faker->name,
            'title' => $this->faker->realText(50),
            'email' => $this->faker->unique()->email,
            'gender' => $this->faker->randomElement(['0','1']),
            'age' => $this->faker->numberBetWeen($min = 1, $max = 1),
            'contact' => $this->faker->realText(200),            
        ];
    }
}
