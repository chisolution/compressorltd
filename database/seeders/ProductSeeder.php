<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $compressors = Category::where('slug', 'air-compressors')->first();
        $generators = Category::where('slug', 'generators')->first();
        $inverters = Category::where('slug', 'inverters')->first();
        $portableGenerators = Category::where('slug', 'portable-generators')->first();

        // Create comprehensive real product data
        $products = [
            // AIR COMPRESSORS
            [
                'name' => 'Atlas Copco GA15 VSD+ Air Compressor',
                'slug' => 'atlas-copco-ga15-vsd-air-compressor',
                'category_id' => $compressors ? $compressors->id : 1,
                'short_description' => 'Variable Speed Drive rotary screw air compressor with advanced energy efficiency and smart controls.',
                'long_description' => '<p>The Atlas Copco GA 15 VSD+ is a state-of-the-art variable speed drive rotary screw air compressor designed for maximum energy efficiency and reliability. This compressor features advanced VSD technology that automatically adjusts motor speed to match air demand, resulting in significant energy savings.</p><h3>Key Features:</h3><ul><li>Variable Speed Drive technology for optimal energy efficiency</li><li>Smart controls with remote monitoring capabilities</li><li>Low noise operation for workplace comfort</li><li>Compact design for space-saving installation</li><li>Advanced filtration system for clean compressed air</li></ul>',
                'price' => 125000.00,
                'sale_price' => null,
                'primary_image' => 'products/atlas-copco-ga15.jpg',
                'status' => 'active',
                'specifications' => '<table><tr><th>Specification</th><th>Value</th></tr><tr><td>Working Pressure</td><td>7.5 - 13 bar</td></tr><tr><td>FAD</td><td>2.4 - 2.7 m³/min</td></tr><tr><td>Motor Power</td><td>15 kW</td></tr><tr><td>Noise Level</td><td>62 dB(A)</td></tr><tr><td>Dimensions</td><td>1200 x 800 x 1400 mm</td></tr></table>',
                'additional_information' => '<p>This compressor comes with a comprehensive 2-year warranty and includes installation and commissioning services. Regular maintenance packages are available to ensure optimal performance and longevity.</p>',
            ],
            [
                'name' => 'Ingersoll Rand R-Series 22kW Rotary Screw Compressor',
                'slug' => 'ingersoll-rand-r-series-22kw-rotary-screw-compressor',
                'category_id' => $compressors ? $compressors->id : 1,
                'short_description' => 'Reliable and efficient rotary screw compressor with proven performance for industrial applications.',
                'long_description' => '<p>The Ingersoll Rand R-Series 22kW rotary screw compressor delivers reliable, efficient compressed air for a wide range of industrial applications. Built with proven technology and robust components, this compressor ensures consistent performance and minimal downtime.</p>',
                'price' => 89500.00,
                'sale_price' => 79900.00,
                'primary_image' => 'products/ingersoll-rand-r22.jpg',
                'status' => 'active',
                'specifications' => '<table><tr><th>Specification</th><th>Value</th></tr><tr><td>Working Pressure</td><td>7.5 - 10 bar</td></tr><tr><td>FAD</td><td>3.8 - 4.2 m³/min</td></tr><tr><td>Motor Power</td><td>22 kW</td></tr><tr><td>Noise Level</td><td>68 dB(A)</td></tr></table>',
                'additional_information' => '<p>Includes integrated air dryer and filtration system. Service support available nationwide.</p>',
            ],
            [
                'name' => 'Cummins C250 D5 Diesel Generator',
                'slug' => 'cummins-c250-d5-diesel-generator',
                'category_id' => $generators ? $generators->id : 2,
                'short_description' => 'Heavy-duty diesel generator with 250kVA capacity, perfect for industrial and commercial backup power.',
                'long_description' => '<p>The Cummins C250 D5 is a robust diesel generator designed to provide reliable backup power for industrial and commercial applications. Featuring a proven Cummins engine and advanced control systems, this generator ensures automatic startup and seamless power transfer during outages.</p>',
                'price' => 185000.00,
                'sale_price' => null,
                'primary_image' => 'products/cummins-c250.jpg',
                'status' => 'active',
                'specifications' => '<table><tr><th>Specification</th><th>Value</th></tr><tr><td>Power Output</td><td>250 kVA / 200 kW</td></tr><tr><td>Engine</td><td>Cummins 6CTA8.3-G2</td></tr><tr><td>Fuel Tank</td><td>400 Liters</td></tr><tr><td>Voltage</td><td>400V, 50Hz</td></tr></table>',
                'additional_information' => '<p>Includes automatic transfer switch and remote monitoring capabilities. Professional installation and commissioning included.</p>',
            ],
            [
                'name' => 'Perkins 100kVA Diesel Generator',
                'slug' => 'perkins-100kva-diesel-generator',
                'category_id' => $generators ? $generators->id : 2,
                'short_description' => 'Compact and efficient 100kVA diesel generator with Perkins engine for reliable standby power.',
                'long_description' => '<p>The Perkins 100kVA diesel generator offers reliable standby power in a compact package. Ideal for medium-sized commercial applications, this generator features a fuel-efficient Perkins engine and user-friendly controls.</p>',
                'price' => 95000.00,
                'sale_price' => 85000.00,
                'primary_image' => 'products/perkins-100kva.jpg',
                'status' => 'active',
                'specifications' => '<table><tr><th>Specification</th><th>Value</th></tr><tr><td>Power Output</td><td>100 kVA / 80 kW</td></tr><tr><td>Engine</td><td>Perkins 1104C-44TAG2</td></tr><tr><td>Fuel Tank</td><td>200 Liters</td></tr></table>',
                'additional_information' => '<p>Weatherproof enclosure available. Maintenance contracts available for ongoing support.</p>',
            ],
            [
                'name' => 'Victron MultiPlus-II 5000VA Inverter',
                'slug' => 'victron-multiplus-ii-5000va-inverter',
                'category_id' => $inverters ? $inverters->id : 3,
                'short_description' => 'Advanced pure sine wave inverter/charger with grid-tie capability and smart energy management.',
                'long_description' => '<p>The Victron MultiPlus-II 5000VA is a powerful inverter/charger that combines the functions of an inverter, battery charger, and transfer switch in one elegant solution. With its advanced features and smart energy management capabilities, it\'s perfect for both off-grid and grid-tie applications.</p>',
                'price' => 25000.00,
                'sale_price' => null,
                'primary_image' => 'products/victron-multiplus-ii.jpg',
                'status' => 'active',
                'specifications' => '<table><tr><th>Specification</th><th>Value</th></tr><tr><td>Continuous Power</td><td>4000W</td></tr><tr><td>Peak Power</td><td>8000W</td></tr><tr><td>Input Voltage</td><td>48V DC</td></tr><tr><td>Output Voltage</td><td>230V AC</td></tr></table>',
                'additional_information' => '<p>Compatible with lithium and lead-acid batteries. Remote monitoring via VRM portal included.</p>',
            ],
            [
                'name' => 'Schneider Conext SW 4024 Inverter',
                'slug' => 'schneider-conext-sw-4024-inverter',
                'category_id' => $inverters ? $inverters->id : 3,
                'short_description' => 'Professional-grade sine wave inverter with integrated battery charger for critical power applications.',
                'long_description' => '<p>The Schneider Conext SW 4024 is a professional-grade sine wave inverter designed for critical power applications. With its robust construction and advanced features, it provides reliable power conversion for residential and commercial installations.</p>',
                'price' => 18500.00,
                'sale_price' => 16900.00,
                'primary_image' => 'products/schneider-conext.jpg',
                'status' => 'active',
                'specifications' => '<table><tr><th>Specification</th><th>Value</th></tr><tr><td>Continuous Power</td><td>4000W</td></tr><tr><td>Input Voltage</td><td>24V DC</td></tr><tr><td>Output Voltage</td><td>230V AC</td></tr></table>',
                'additional_information' => '<p>Includes system control panel and monitoring software. Professional installation recommended.</p>',
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }
    }
}
