<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class RealProductSeeder extends Seeder
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

        // Create categories if they don't exist
        if (!$compressors) {
            $compressors = Category::create([
                'name' => 'Air Compressors',
                'slug' => 'air-compressors',
                'description' => 'Industrial and commercial air compressors for various applications',
                'parent_id' => null,
            ]);
        }

        if (!$generators) {
            $generators = Category::create([
                'name' => 'Generators',
                'slug' => 'generators',
                'description' => 'Power generators for backup and primary power solutions',
                'parent_id' => null,
            ]);
        }

        if (!$inverters) {
            $inverters = Category::create([
                'name' => 'Inverters',
                'slug' => 'inverters',
                'description' => 'Power inverters and conversion equipment',
                'parent_id' => null,
            ]);
        }

        // Create subcategories for air compressors
        $rotaryScrew = Category::firstOrCreate([
            'slug' => 'rotary-screw-compressors'
        ], [
            'name' => 'Rotary Screw Compressors',
            'description' => 'Oil-injected and oil-free rotary screw air compressors',
            'parent_id' => $compressors->id,
        ]);

        $pistonCompressors = Category::firstOrCreate([
            'slug' => 'piston-compressors'
        ], [
            'name' => 'Piston Compressors',
            'description' => 'Two-stage and single-stage piston air compressors',
            'parent_id' => $compressors->id,
        ]);

        $portableCompressors = Category::firstOrCreate([
            'slug' => 'portable-compressors'
        ], [
            'name' => 'Portable Compressors',
            'description' => 'Mobile and trailer-mounted air compressors',
            'parent_id' => $compressors->id,
        ]);

        $airDryers = Category::firstOrCreate([
            'slug' => 'air-dryers'
        ], [
            'name' => 'Air Dryers',
            'description' => 'Refrigerated and desiccant air dryers',
            'parent_id' => $compressors->id,
        ]);

        // Real products from the data file
        $products = [
            // Atlas Copco XAS 400-150 PACE Portable Rotary Screw Air Compressor
            [
                'name' => 'Atlas Copco XAS 400-150 PACE Portable Rotary Screw Air Compressor',
                'slug' => 'atlas-copco-xas-400-150-pace-portable-rotary-screw-air-compressor',
                'category_id' => $portableCompressors->id,
                'short_description' => '148 HP portable rotary screw air compressor with 400 CFM at 150 PSI, featuring John Deere T4F diesel engine.',
                'long_description' => 'The Atlas Copco XAS 400-150 PACE is a high-performance portable rotary screw air compressor designed for demanding applications. With its powerful 148 HP John Deere T4F liquid-cooled, turbo charged diesel engine and C106 screw element, this unit delivers reliable 400 CFM at 150 PSI. The heavy duty single axle trailer with 15" tires ensures easy transportation to any job site.',
                'specifications' => json_encode([
                    'Power' => '148 HP',
                    'Air Flow' => '400 CFM at 150 PSI',
                    'Pressure Range' => '100 to 150 PSI',
                    'Engine' => 'John Deere T4F liquid-cooled, turbo charged diesel',
                    'Screw Element' => 'C106',
                    'Air Receiver' => '11 gallon capacity',
                    'Controller' => 'Atlas Copco XC2003 PACE Controller',
                    'Trailer' => 'Heavy duty single axle with 15" tires',
                    'Enclosure' => '1/4" double wall polyethylene'
                ]),
                'additional_information' => 'Perfect for construction sites, mining operations, and industrial applications requiring high-volume compressed air.',
                'primary_image' => 'products/atlas-copco-xas-400-150.jpg',
                'status' => 'active',
                'featured' => true,
            ],

            // Atlas Copco FD VSD Refrigerated Air Dryer
            [
                'name' => 'Atlas Copco FD VSD Refrigerated Air Dryer',
                'slug' => 'atlas-copco-fd-vsd-refrigerated-air-dryer',
                'category_id' => $airDryers->id,
                'short_description' => 'Variable Speed Drive refrigerated air dryer available in 6 sizes from 212 to 636 CFM with integrated VSD inverter.',
                'long_description' => 'The Atlas Copco FD VSD Refrigerated Air Dryer offers exceptional energy efficiency with its variable speed drive technology. Available in multiple sizes to match your compressed air system requirements, featuring the advanced Elektronikon® Touch controller for optimal performance monitoring and control.',
                'specifications' => json_encode([
                    'Capacity Range' => '212 to 636 CFM (6 sizes available)',
                    'Maximum Inlet Conditions' => '46°C at full flow (ambient/inlet)',
                    'Pressure Drop' => '1.5 to 2.6 psi at full flow',
                    'Power Consumption' => '0.66 to 2.64 kW',
                    'Maximum Working Pressure' => '210 psi',
                    'Features' => 'VSD inverter, Integrated water separator, Electronic no-loss condensate drain',
                    'Controller' => 'Elektronikon® Touch controller',
                    'Installation' => 'Single electrical connection for plug-and-play'
                ]),
                'additional_information' => 'Energy-efficient solution for removing moisture from compressed air systems.',
                'primary_image' => 'products/atlas-copco-fd-vsd-dryer.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Atlas Copco FX 9-572 CFM Refrigerated Air Dryer
            [
                'name' => 'Atlas Copco FX 9-572 CFM Refrigerated Air Dryer',
                'slug' => 'atlas-copco-fx-9-572-cfm-refrigerated-air-dryer',
                'category_id' => $airDryers->id,
                'short_description' => 'High-capacity refrigerated air dryer with digital display for precise pressure dew point monitoring.',
                'long_description' => 'The Atlas Copco FX series refrigerated air dryer provides reliable moisture removal with advanced monitoring capabilities. Features integrated separators and F-Gas compliant refrigerant for environmental compliance.',
                'specifications' => json_encode([
                    'Capacity' => '9-572 CFM',
                    'Maximum Working Pressure' => '203 or 232 PSI options',
                    'Pressure Drop' => '0.725 to 2.61 PSI',
                    'Dew Point' => 'As low as 3°C/37.4°F',
                    'Connections' => '3/4", 1", 1.5", and 2" NPT compressed air',
                    'Refrigerant' => 'F-Gas regulations compliant',
                    'Separators' => 'Integrated refrigerant, liquid, and water separators',
                    'Installation' => 'Single electrical connection for plug-and-play',
                    'Display' => 'Digital display for pressure dew point monitoring'
                ]),
                'additional_information' => 'Ideal for applications requiring precise moisture control and monitoring.',
                'primary_image' => 'products/atlas-copco-fx-dryer.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Atlas Copco GA 132 VSD
            [
                'name' => 'Atlas Copco GA 132 VSD, 175 HP Rotary Screw Air Compressor with VFD',
                'slug' => 'atlas-copco-ga-132-vsd-175-hp-rotary-screw-air-compressor',
                'category_id' => $rotaryScrew->id,
                'short_description' => '175 HP air-cooled rotary screw air compressor with Variable Speed Drive for maximum energy efficiency.',
                'long_description' => 'The Atlas Copco GA 132 VSD represents the pinnacle of energy-efficient compressed air technology. With its advanced Variable Speed Drive system, this 175 HP unit automatically adjusts motor speed to match air demand, resulting in significant energy savings.',
                'specifications' => json_encode([
                    'Model' => 'GA 132 VSD',
                    'Power' => '175 HP',
                    'Cooling' => 'Air Cooled',
                    'Drive System' => 'Variable Speed Drive (VSD)',
                    'Brand' => 'Atlas Copco',
                    'Energy Efficiency' => 'Premium efficiency with VSD technology',
                    'Applications' => 'Industrial, manufacturing, automotive'
                ]),
                'additional_information' => 'Price negotiable. Contact us for detailed specifications and pricing.',
                'primary_image' => 'products/atlas-copco-ga-132-vsd.jpg',
                'status' => 'active',
                'featured' => true,
            ],

            // Atlas Copco XAS-110-KD
            [
                'name' => 'Atlas Copco XAS-110-KD Portable Rotary Screw Air Compressor',
                'slug' => 'atlas-copco-xas-110-kd-portable-rotary-screw-air-compressor',
                'category_id' => $portableCompressors->id,
                'short_description' => '24 HP portable rotary screw air compressor with 110 CFM at 100 PSI, powered by Kubota Tier 4 Final diesel engine.',
                'long_description' => 'The Atlas Copco XAS-110-KD is a compact and efficient portable air compressor perfect for small to medium construction and industrial applications. Features the reliable Kubota D902 Tier 4 Final diesel engine and C67 screw element for consistent performance.',
                'specifications' => json_encode([
                    'Power' => '24 HP',
                    'Air Flow' => '110 CFM at 100 PSI',
                    'Engine' => 'Kubota D902 Tier 4 Final Diesel',
                    'Screw Element' => 'C67',
                    'Emissions' => 'Tier 4 Final compliant',
                    'Applications' => 'Construction, maintenance, small industrial'
                ]),
                'additional_information' => 'Compact design ideal for tight spaces and mobile applications.',
                'primary_image' => 'products/atlas-copco-xas-110-kd.jpg',
                'status' => 'active',
                'featured' => false,
                'price' => 12000.00,
            ],

            // Atlas Copco CR Industrial Series Two Stage Piston Air Compressor
            [
                'name' => 'Atlas Copco CR Industrial Series Two Stage Piston Air Compressor',
                'slug' => 'atlas-copco-cr-industrial-series-two-stage-piston-air-compressor',
                'category_id' => $pistonCompressors->id,
                'short_description' => 'Industrial two-stage piston air compressor with 5-15 HP motor options and 175 PSI max operating pressure.',
                'long_description' => 'The Atlas Copco CR Industrial Series offers robust two-stage piston compression technology for demanding industrial applications. Available in both Simplex and Duplex configurations with various motor options and receiver tank sizes.',
                'specifications' => json_encode([
                    'Motor Options' => '5, 7.5, 10, and 15 HP',
                    'Configurations' => 'Simplex or Duplex models available',
                    'Motors' => 'ODP motors standard, optional TEFC/NEMA 4',
                    'Maximum Pressure' => '175 PSI',
                    'Capacity Simplex' => '17.4 to 15.1 CFM',
                    'Capacity Duplex' => '34.8 to 72 CFM',
                    'Safety Features' => 'Fully enclosed belt guard and ASME safety valves',
                    'Starters' => 'Simplex: Magnetic, Duplex: Panel',
                    'Receiver Tanks' => '80, 120, and 200 gallon options'
                ]),
                'additional_information' => 'Heavy-duty industrial design for continuous operation in demanding environments.',
                'primary_image' => 'products/atlas-copco-cr-industrial.jpg',
                'status' => 'active',
                'featured' => false,
                'price' => 4000.00,
            ],

            // Atlas Copco SF8-22 Oilless Scroll Air Compressor
            [
                'name' => 'Atlas Copco SF8-22 Oilless Scroll Air Compressor',
                'slug' => 'atlas-copco-sf8-22-oilless-scroll-air-compressor',
                'category_id' => $rotaryScrew->id,
                'short_description' => 'Oil-free scroll air compressor with 10-30 HP options and ultra-quiet operation at 63-65 dB(A).',
                'long_description' => 'The Atlas Copco SF8-22 series provides 100% oil-free compressed air with scroll technology. Perfect for applications requiring clean air such as food processing, pharmaceuticals, and electronics manufacturing.',
                'specifications' => json_encode([
                    'Mounting' => 'Base mounted',
                    'Power Range' => '10 to 30 HP',
                    'Capacity' => '24.2 to 86.5 CFM',
                    'Maximum Pressure' => '116 or 145 psi options',
                    'Voltage Options' => '200, 230, or 460V',
                    'Air Dryer' => 'Integrated refrigerant air dryer option available',
                    'Noise Level' => '63 to 65 dB(A)',
                    'Air Quality' => '100% oil-free'
                ]),
                'additional_information' => 'Ideal for applications requiring clean, oil-free compressed air.',
                'primary_image' => 'products/atlas-copco-sf8-22.jpg',
                'status' => 'active',
                'featured' => true,
                'price' => 10000.00,
            ],

            // Atlas Copco G2-7 Series Oil-Injected Rotary Screw Compressor
            [
                'name' => 'Atlas Copco G2-7 Series Oil-Injected Rotary Screw Compressor',
                'slug' => 'atlas-copco-g2-7-series-oil-injected-rotary-screw-compressor',
                'category_id' => $rotaryScrew->id,
                'short_description' => 'Compact rotary screw compressor with 3-10 HP options and integrated Elektronikon Base controller.',
                'long_description' => 'The Atlas Copco G2-7 Series combines reliability with efficiency in a compact package. Features premium IE3 motor and advanced Elektronikon Base controller for optimal performance monitoring.',
                'specifications' => json_encode([
                    'Maximum Pressure' => '116 and 145 PSI options',
                    'Receiver' => '1 or 3 phase',
                    'Capacity' => '9.7 to 36 CFM',
                    'Power Range' => '3 to 10 HP',
                    'Oil Carryover' => '5 ppm',
                    'Air Tank' => '53 gallon for tank mount options',
                    'Air Dryer' => 'Integrated air dryer options available',
                    'Motor' => 'IE3 premium-efficiency motor',
                    'Controller' => 'Elektronikon Base controller'
                ]),
                'additional_information' => 'Perfect for small to medium workshops and light industrial applications.',
                'primary_image' => 'products/atlas-copco-g2-7.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Atlas Copco AR Series Aluminum Piston Air Compressor
            [
                'name' => 'Atlas Copco AR Series Aluminum Piston Air Compressor',
                'slug' => 'atlas-copco-ar-series-aluminum-piston-air-compressor',
                'category_id' => $pistonCompressors->id,
                'short_description' => 'Lightweight aluminum piston air compressor with 5-7.5 HP options and 175 PSI max pressure rating.',
                'long_description' => 'The Atlas Copco AR Series features durable aluminum construction for reduced weight and excellent heat dissipation. Available in multiple configurations to suit various application requirements.',
                'specifications' => json_encode([
                    'Power Options' => '5 or 7.5 HP',
                    'Capacity' => '14.6 to 22.2 CFM',
                    'Maximum Pressure' => '175 PSI',
                    'Voltage Options' => '230 or 460V',
                    'Configuration 1' => 'Pressure Switch Starter',
                    'Configuration 2' => 'Magnetic Starter',
                    'Configuration 3' => 'Magnetic Starter with Pneumatic Drain and Low Oil Level Switch',
                    'Construction' => 'Aluminum for lightweight and heat dissipation'
                ]),
                'additional_information' => 'Reliable and efficient solution for automotive, maintenance, and light manufacturing applications.',
                'primary_image' => 'products/atlas-copco-ar-series.jpg',
                'status' => 'active',
                'featured' => false,
                'price' => 1800.00,
            ],

            // Ingersoll Rand R-Series Fixed Speed Rotary Screw Air Compressor
            [
                'name' => 'Ingersoll Rand R-Series Fixed Speed Rotary Screw Air Compressor',
                'slug' => 'ingersoll-rand-r-series-fixed-speed-rotary-screw-air-compressor',
                'category_id' => $rotaryScrew->id,
                'short_description' => 'Fixed speed rotary screw air compressor with 41.5-57.5 CFM capacity and quiet enclosure down to 69dBA.',
                'long_description' => 'The Ingersoll Rand R-Series delivers reliable compressed air with advanced Xe-50M controller and optional Total Air System (TAS) for complete air treatment solutions.',
                'specifications' => json_encode([
                    'Mounting' => 'Baseplate or tank mounted',
                    'Tank Options' => '80 or 120 gallon tanks available',
                    'Capacity' => '41.5 to 57.5 CFM',
                    'Motor' => 'Tri-voltage 200-230/460V 3-phase standard',
                    'Optional Motors' => '575V 3-phase and 208/230V 1-phase on some models',
                    'Controller' => 'Xe-50M standard (Xe-70M options available)',
                    'Pre-filters' => 'Standard package pre-filters',
                    'Control' => 'Manual load/unload control',
                    'Display' => '2.1in monochrome display',
                    'Noise Level' => 'Quiet enclosure down to 69dBA',
                    'TAS Options' => 'General purpose and high-efficiency filters, Integrated dryer, 3-in-1 heat exchanger'
                ]),
                'additional_information' => 'Versatile solution with optional Total Air System for complete compressed air treatment.',
                'primary_image' => 'products/ingersoll-rand-r-series.jpg',
                'status' => 'active',
                'featured' => false,
                'price' => 4500.00,
            ],

            // Ingersoll Rand UP6 Oil Flooded Rotary Screw Air Compressor
            [
                'name' => 'Ingersoll Rand UP6 Oil Flooded Rotary Screw Air Compressor',
                'slug' => 'ingersoll-rand-up6-oil-flooded-rotary-screw-air-compressor',
                'category_id' => $rotaryScrew->id,
                'short_description' => '7.5 HP oil-flooded rotary screw air compressor with Poly-V belt drive system and multiple voltage options.',
                'long_description' => 'The Ingersoll Rand UP6 series offers reliable oil-flooded rotary screw technology with efficient Poly-V belt drive system. Available with optional tank mounting for increased air storage.',
                'specifications' => json_encode([
                    'Power' => '7.5 HP',
                    'Capacity' => '26 or 23 CFM',
                    'Motor Options' => '200V, 230V, 460V, or 575V ODP',
                    'Starter' => 'Full voltage starter',
                    'Drive System' => 'Poly-V belt drive system',
                    'Standard Mounting' => 'Baseplate mounted',
                    'Optional Tanks' => '80 or 120 gallon tanks with mounting available'
                ]),
                'additional_information' => 'Compact and efficient design suitable for workshops and light industrial applications.',
                'primary_image' => 'products/ingersoll-rand-up6.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Ingersoll Rand 2475 Diesel Powered Two-Stage Piston Air Compressor
            [
                'name' => 'Ingersoll Rand 2475 Diesel Powered Two-Stage Piston Air Compressor',
                'slug' => 'ingersoll-rand-2475-diesel-powered-two-stage-piston-air-compressor',
                'category_id' => $portableCompressors->id,
                'short_description' => 'Diesel-powered two-stage piston air compressor with Kohler or Yanmar 10 HP engine options.',
                'long_description' => 'The Ingersoll Rand 2475 series provides reliable compressed air in remote locations with diesel power. Features both pull and electric start options for maximum convenience.',
                'specifications' => json_encode([
                    'Engine Option 1' => 'Kohler 10 HP, 22 CFM at 175psi',
                    'Engine Option 2' => 'Yanmar 10 HP, 22.6 CFM at 175psi',
                    'Tank Drain' => 'Manual tank drain',
                    'Starting' => 'Pull and electric start',
                    'Safety' => 'Enclosed belt guard',
                    'Fuel Type' => 'Diesel',
                    'Stage' => 'Two-stage compression'
                ]),
                'additional_information' => 'Perfect for remote job sites and applications where electric power is not available.',
                'primary_image' => 'products/ingersoll-rand-2475.jpg',
                'status' => 'active',
                'featured' => false,
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
