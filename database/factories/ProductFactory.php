<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufactures;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first(); 
        $manufacture = Manufactures::inRandomOrder()->first();
        // $imageName = $this->faker->image('public/images', 640, 480, null, false); 
        $imageName = '1743936877.jpg';
        return [
            'name' => $this->faker->word, // Tạo tên sản phẩm ngẫu nhiên
            'description' => $this->faker->text, // Mô tả ngẫu nhiên
            'price' => $this->faker->randomFloat(2, 50, 500), // Giá ngẫu nhiên từ 50 đến 500
            'category_id' => $category->category_id, // Liên kết với danh mục ngẫu nhiên
            'manu_id' => $manufacture->manu_id, // Liên kết với nhà sản xuất ngẫu nhiên
            'image' => $imageName,
        ];
    }
}
