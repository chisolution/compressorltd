<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create blog categories first
        $categories = [
            [
                'name' => 'Product Guides',
                'slug' => 'product-guides',
                'description' => 'Comprehensive guides to help you choose and use our products effectively.',
                'active' => true,
            ],
            [
                'name' => 'Maintenance Tips',
                'slug' => 'maintenance-tips',
                'description' => 'Expert advice on maintaining your equipment for optimal performance.',
                'active' => true,
            ],
            [
                'name' => 'Industry Insights',
                'slug' => 'industry-insights',
                'description' => 'Latest trends and insights from the power and compression industry.',
                'active' => true,
            ],
            [
                'name' => 'Technology Updates',
                'slug' => 'technology-updates',
                'description' => 'Updates on the latest technological advances in our field.',
                'active' => true,
            ],
            [
                'name' => 'Case Studies',
                'slug' => 'case-studies',
                'description' => 'Real-world applications and success stories from our customers.',
                'active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            BlogCategory::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Get categories for blog posts
        $productGuides = BlogCategory::where('slug', 'product-guides')->first();
        $maintenanceTips = BlogCategory::where('slug', 'maintenance-tips')->first();
        $industryInsights = BlogCategory::where('slug', 'industry-insights')->first();
        $technologyUpdates = BlogCategory::where('slug', 'technology-updates')->first();
        $caseStudies = BlogCategory::where('slug', 'case-studies')->first();

        // Create comprehensive blog posts
        $blogPosts = [
            [
                'title' => 'How to Choose the Right Air Compressor for Your Industrial Application',
                'slug' => 'how-to-choose-right-air-compressor-industrial-application',
                'excerpt' => 'Understanding the key factors to consider when selecting an air compressor for your specific industry needs, including capacity, pressure requirements, and energy efficiency.',
                'content' => $this->getCompressorGuideContent(),
                'blog_category_id' => $productGuides->id,
                'featured_image' => 'blogs/compressor-guide.jpg',
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::now()->subDays(5),
                'meta_title' => 'Complete Guide: Choosing the Right Industrial Air Compressor',
                'meta_description' => 'Expert guide on selecting the perfect air compressor for industrial applications. Learn about capacity, pressure, efficiency, and cost considerations.',
                'meta_keywords' => 'air compressor, industrial equipment, compressor selection, pneumatic tools, compressed air systems',
            ],
            [
                'title' => 'Essential Preventive Maintenance Checklist for Air Compressors',
                'slug' => 'essential-preventive-maintenance-checklist-air-compressors',
                'excerpt' => 'A comprehensive maintenance guide to extend the life of your air compressor, reduce downtime, and ensure optimal performance year-round.',
                'content' => $this->getMaintenanceContent(),
                'blog_category_id' => $maintenanceTips->id,
                'featured_image' => 'blogs/maintenance-checklist.jpg',
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::now()->subDays(12),
                'meta_title' => 'Air Compressor Maintenance: Complete Preventive Care Guide',
                'meta_description' => 'Essential maintenance checklist for air compressors. Learn daily, weekly, and monthly maintenance tasks to maximize equipment lifespan.',
                'meta_keywords' => 'compressor maintenance, preventive maintenance, equipment care, industrial maintenance, compressor service',
            ],
            [
                'title' => 'The Future of Energy-Efficient Compressor Technology in 2025',
                'slug' => 'future-energy-efficient-compressor-technology-2025',
                'excerpt' => 'Exploring the latest innovations in energy-efficient compressor technology and their impact on reducing operational costs and environmental footprint.',
                'content' => $this->getTechnologyContent(),
                'blog_category_id' => $technologyUpdates->id,
                'featured_image' => 'blogs/energy-efficient-tech.jpg',
                'status' => 'published',
                'featured' => false,
                'published_at' => Carbon::now()->subDays(8),
                'meta_title' => 'Energy-Efficient Compressor Technology Trends 2025',
                'meta_description' => 'Discover the latest energy-efficient compressor technologies for 2025. Learn about variable speed drives, smart controls, and green innovations.',
                'meta_keywords' => 'energy efficient compressors, green technology, variable speed drives, smart compressors, sustainable equipment',
            ],
        ];

        foreach ($blogPosts as $postData) {
            Blog::firstOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );
        }
    }

    private function getCompressorGuideContent()
    {
        return '<h2>Understanding Your Compressed Air Requirements</h2>

<p>Selecting the right air compressor for your industrial application is a critical decision that affects productivity, energy costs, and operational efficiency. This comprehensive guide will walk you through the essential factors to consider when making this important investment.</p>

<h3>1. Determine Your Air Flow Requirements (CFM)</h3>

<p>The first step in choosing an air compressor is calculating your Cubic Feet per Minute (CFM) requirements. This involves:</p>

<ul>
<li><strong>Inventory all pneumatic tools and equipment</strong> that will be connected to the system</li>
<li><strong>Calculate total CFM demand</strong> by adding individual tool requirements</li>
<li><strong>Apply a safety factor</strong> of 20-30% for future expansion and peak demand</li>
<li><strong>Consider duty cycle</strong> - not all tools operate simultaneously</li>
</ul>

<h3>2. Pressure Requirements (PSI)</h3>

<p>Different applications require different pressure levels:</p>

<ul>
<li><strong>Light industrial applications:</strong> 90-125 PSI</li>
<li><strong>Heavy industrial applications:</strong> 125-175 PSI</li>
<li><strong>Specialized applications:</strong> Up to 500+ PSI</li>
</ul>

<h3>3. Types of Air Compressors</h3>

<h4>Rotary Screw Compressors</h4>
<p>Best for continuous operation, high efficiency, and industrial applications requiring consistent air supply.</p>

<h4>Reciprocating (Piston) Compressors</h4>
<p>Ideal for intermittent use, smaller operations, and applications with varying air demand.</p>

<h4>Centrifugal Compressors</h4>
<p>Perfect for large-scale operations requiring high volumes of compressed air.</p>

<h3>4. Energy Efficiency Considerations</h3>

<p>Energy costs typically account for 70-80% of a compressor\'s total cost of ownership. Consider:</p>

<ul>
<li><strong>Variable Speed Drive (VSD) technology</strong> for varying demand applications</li>
<li><strong>Energy recovery systems</strong> to capture waste heat</li>
<li><strong>Premium efficiency motors</strong> and components</li>
<li><strong>Proper sizing</strong> to avoid oversizing and energy waste</li>
</ul>

<h3>5. Installation and Infrastructure Requirements</h3>

<p>Plan for:</p>

<ul>
<li><strong>Adequate ventilation</strong> and cooling</li>
<li><strong>Electrical requirements</strong> and power supply</li>
<li><strong>Foundation and mounting</strong> considerations</li>
<li><strong>Air distribution system</strong> design</li>
<li><strong>Condensate management</strong> and drainage</li>
</ul>

<h3>Conclusion</h3>

<p>Choosing the right air compressor requires careful analysis of your specific needs, operating conditions, and long-term goals. Our team of experts is ready to help you make the best decision for your application. Contact us today for a personalized consultation and quote.</p>';
    }

    private function getMaintenanceContent()
    {
        return '<h2>Maximizing Your Air Compressor\'s Lifespan Through Proper Maintenance</h2>

<p>Regular maintenance is the key to ensuring your air compressor operates efficiently, reliably, and safely for years to come. This comprehensive checklist will help you establish a maintenance routine that prevents costly breakdowns and extends equipment life.</p>

<h3>Daily Maintenance Tasks (5-10 minutes)</h3>

<h4>Visual Inspection</h4>
<ul>
<li><strong>Check for oil leaks</strong> around the compressor unit</li>
<li><strong>Inspect air lines and connections</strong> for damage or loose fittings</li>
<li><strong>Verify proper oil level</strong> using the sight glass or dipstick</li>
<li><strong>Check operating temperature</strong> and pressure gauges</li>
<li><strong>Listen for unusual noises</strong> during operation</li>
</ul>

<h4>Condensate Drainage</h4>
<p>Drain moisture from the air receiver tank and moisture separators to prevent corrosion and contamination.</p>

<h3>Weekly Maintenance Tasks (30-45 minutes)</h3>

<h4>Air Filter Inspection</h4>
<ul>
<li><strong>Remove and inspect air intake filter</strong></li>
<li><strong>Clean or replace if dirty</strong> (dirty filters reduce efficiency by up to 15%)</li>
<li><strong>Check filter housing</strong> for damage or loose connections</li>
</ul>

<h4>Belt and Coupling Inspection</h4>
<ul>
<li><strong>Check belt tension</strong> - should deflect 1/2 to 3/4 inch under moderate pressure</li>
<li><strong>Inspect for wear, cracking, or fraying</strong></li>
<li><strong>Verify proper alignment</strong> of pulleys and couplings</li>
</ul>

<h3>Monthly Maintenance Tasks (1-2 hours)</h3>

<h4>Oil System Maintenance</h4>
<ul>
<li><strong>Check oil quality</strong> - should be clear and free of contamination</li>
<li><strong>Test oil temperature</strong> during operation</li>
<li><strong>Inspect oil cooler</strong> for cleanliness and proper airflow</li>
<li><strong>Check oil filter condition</strong> and replace if necessary</li>
</ul>

<h4>Cooling System</h4>
<ul>
<li><strong>Clean cooling fins and heat exchangers</strong> with compressed air</li>
<li><strong>Check cooling fan operation</strong> and belt condition</li>
<li><strong>Verify adequate ventilation</strong> around the compressor</li>
</ul>

<h3>Quarterly Maintenance Tasks (2-4 hours)</h3>

<h4>Comprehensive System Check</h4>
<ul>
<li><strong>Change compressor oil</strong> and oil filter</li>
<li><strong>Replace air/oil separator element</strong></li>
<li><strong>Test safety valves</strong> and pressure switches</li>
<li><strong>Calibrate pressure gauges</strong> and instruments</li>
<li><strong>Inspect electrical connections</strong> and motor condition</li>
</ul>

<h4>Performance Testing</h4>
<ul>
<li><strong>Measure actual CFM output</strong> vs. rated capacity</li>
<li><strong>Check operating pressures</strong> and temperatures</li>
<li><strong>Test automatic controls</strong> and safety systems</li>
<li><strong>Analyze energy consumption</strong> trends</li>
</ul>

<h3>Annual Maintenance Tasks (Professional Service Recommended)</h3>

<h4>Major Component Inspection</h4>
<ul>
<li><strong>Internal inspection</strong> of compressor elements</li>
<li><strong>Valve inspection and testing</strong></li>
<li><strong>Motor and electrical system analysis</strong></li>
<li><strong>Vibration analysis</strong> and alignment check</li>
<li><strong>Complete system performance evaluation</strong></li>
</ul>

<h3>Warning Signs That Require Immediate Attention</h3>

<ul>
<li><strong>Unusual noises:</strong> grinding, knocking, or squealing sounds</li>
<li><strong>Excessive vibration</strong> or movement during operation</li>
<li><strong>Oil contamination:</strong> milky, dark, or metallic particles in oil</li>
<li><strong>Overheating:</strong> operating temperatures above normal range</li>
<li><strong>Pressure loss:</strong> inability to maintain rated pressure</li>
<li><strong>Excessive oil consumption</strong> or visible oil leaks</li>
</ul>

<h3>Maintenance Record Keeping</h3>

<p>Maintain detailed records of all maintenance activities, including:</p>

<ul>
<li>Date and type of maintenance performed</li>
<li>Parts replaced and oil changes</li>
<li>Operating hours and performance data</li>
<li>Any issues or abnormalities noted</li>
<li>Technician performing the work</li>
</ul>

<h3>Professional Service and Support</h3>

<p>While many maintenance tasks can be performed by your maintenance team, annual inspections and major repairs should be handled by certified technicians. Our service team offers comprehensive maintenance programs tailored to your specific equipment and operating conditions.</p>

<p>Contact us today to discuss a preventive maintenance program that will keep your compressor running at peak efficiency and minimize unexpected downtime.</p>';
    }

    private function getTechnologyContent()
    {
        return '<h2>Revolutionary Advances in Compressor Technology for 2025</h2>

<p>The compressed air industry is experiencing unprecedented innovation as manufacturers respond to growing demands for energy efficiency, environmental sustainability, and smart automation. Here\'s a comprehensive look at the technologies shaping the future of compressed air systems.</p>

<h3>1. Variable Speed Drive (VSD) Technology Evolution</h3>

<h4>Next-Generation VSD Systems</h4>
<p>Modern VSD compressors now feature:</p>

<ul>
<li><strong>Advanced motor control algorithms</strong> that optimize efficiency across the entire operating range</li>
<li><strong>Magnetic bearing technology</strong> eliminating mechanical wear and maintenance</li>
<li><strong>Integrated IoT sensors</strong> for real-time performance monitoring</li>
<li><strong>Predictive maintenance capabilities</strong> using AI-driven analytics</li>
</ul>

<h4>Energy Savings Impact</h4>
<p>Latest VSD systems can achieve energy savings of 35-50% compared to fixed-speed compressors, with payback periods often under 18 months.</p>

<h3>2. Smart Compressor Systems and Industry 4.0 Integration</h3>

<h4>Intelligent Control Systems</h4>
<ul>
<li><strong>Machine learning algorithms</strong> that adapt to usage patterns</li>
<li><strong>Automated demand forecasting</strong> for optimal system sizing</li>
<li><strong>Remote monitoring and diagnostics</strong> via cloud platforms</li>
<li><strong>Integration with building management systems</strong> for holistic energy management</li>
</ul>

<h4>Predictive Maintenance Revolution</h4>
<p>AI-powered systems now predict component failures weeks in advance, reducing unplanned downtime by up to 70% and maintenance costs by 25%.</p>

<h3>3. Heat Recovery and Energy Recycling</h3>

<h4>Advanced Heat Recovery Systems</h4>
<p>Modern compressors can recover up to 94% of electrical energy as usable heat for:</p>

<ul>
<li><strong>Space heating</strong> in industrial facilities</li>
<li><strong>Process heating</strong> for manufacturing operations</li>
<li><strong>Hot water generation</strong> for facility use</li>
<li><strong>Absorption cooling</strong> for air conditioning systems</li>
</ul>

<h4>Thermal Energy Storage</h4>
<p>New thermal storage systems allow facilities to store recovered heat energy for use during peak demand periods, further optimizing energy costs.</p>

<h3>4. Oil-Free Technology Advancements</h3>

<h4>Enhanced Oil-Free Designs</h4>
<ul>
<li><strong>Improved coating technologies</strong> for longer component life</li>
<li><strong>Advanced filtration systems</strong> ensuring 100% oil-free air</li>
<li><strong>Reduced maintenance requirements</strong> through better materials</li>
<li><strong>Higher efficiency ratings</strong> matching oil-lubricated systems</li>
</ul>

<h3>5. Environmental and Sustainability Features</h3>

<h4>Green Refrigerants and Materials</h4>
<ul>
<li><strong>Zero-ODP refrigerants</strong> in cooling systems</li>
<li><strong>Recyclable component materials</strong> for end-of-life sustainability</li>
<li><strong>Reduced noise emissions</strong> for better workplace environments</li>
<li><strong>Biodegradable lubricants</strong> where oil is required</li>
</ul>

<h4>Carbon Footprint Reduction</h4>
<p>New compressor technologies can reduce carbon emissions by 40-60% through improved efficiency and renewable energy integration.</p>

<h3>6. Modular and Scalable Systems</h3>

<h4>Flexible System Architecture</h4>
<ul>
<li><strong>Modular compressor units</strong> for easy capacity expansion</li>
<li><strong>Plug-and-play installation</strong> reducing setup time</li>
<li><strong>Distributed system designs</strong> for improved reliability</li>
<li><strong>Standardized interfaces</strong> for seamless integration</li>
</ul>

<h3>7. Advanced Materials and Manufacturing</h3>

<h4>Next-Generation Components</h4>
<ul>
<li><strong>Ceramic and composite materials</strong> for extreme durability</li>
<li><strong>3D-printed components</strong> for optimized performance</li>
<li><strong>Nano-coatings</strong> for enhanced efficiency and longevity</li>
<li><strong>Smart materials</strong> that adapt to operating conditions</li>
</ul>

<h3>8. Integration with Renewable Energy</h3>

<h4>Solar and Wind Integration</h4>
<p>Modern compressor systems can:</p>

<ul>
<li><strong>Automatically adjust operation</strong> based on renewable energy availability</li>
<li><strong>Store compressed air</strong> as energy storage medium</li>
<li><strong>Optimize grid interaction</strong> for demand response programs</li>
<li><strong>Reduce peak demand charges</strong> through intelligent scheduling</li>
</ul>

<h3>The Road Ahead: What to Expect</h3>

<h4>Emerging Technologies</h4>
<ul>
<li><strong>Quantum sensors</strong> for ultra-precise monitoring</li>
<li><strong>Blockchain integration</strong> for supply chain transparency</li>
<li><strong>Augmented reality</strong> for maintenance and training</li>
<li><strong>Autonomous operation</strong> with minimal human intervention</li>
</ul>

<h3>Making the Transition</h3>

<p>Upgrading to next-generation compressor technology requires careful planning and expert guidance. Consider:</p>

<ul>
<li><strong>Energy audit</strong> of current systems</li>
<li><strong>ROI analysis</strong> for different technology options</li>
<li><strong>Integration planning</strong> with existing infrastructure</li>
<li><strong>Training requirements</strong> for maintenance staff</li>
</ul>

<h3>Conclusion</h3>

<p>The future of compressed air technology is bright, with innovations that promise significant improvements in efficiency, reliability, and environmental impact. As these technologies mature and become more accessible, businesses that embrace them early will gain competitive advantages through reduced operating costs and improved sustainability.</p>

<p>Our team stays at the forefront of these technological advances, helping customers navigate the transition to next-generation compressed air systems. Contact us to learn how these innovations can benefit your operation.</p>';
    }
}
