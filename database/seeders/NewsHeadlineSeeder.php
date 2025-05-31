<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;

class NewsHeadlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create blog categories first if they don't exist
        $categories = [
            [
                'name' => 'Company News',
                'slug' => 'company-news',
                'description' => 'Latest updates and announcements from our company.',
                'active' => true,
            ],
            [
                'name' => 'Press Releases',
                'slug' => 'press-releases',
                'description' => 'Official press releases and media information.',
                'active' => true,
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
                'description' => 'Information about upcoming trade shows, webinars, and other events.',
                'active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            BlogCategory::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Get categories for news posts
        $companyNews = BlogCategory::where('slug', 'company-news')->first();
        $pressReleases = BlogCategory::where('slug', 'press-releases')->first();
        $events = BlogCategory::where('slug', 'events')->first();

        // Create news headlines
        $newsHeadlines = [
            [
                'title' => 'CompressorLTD Expands Manufacturing Capacity with New Facility',
                'slug' => 'compressorltd-expands-manufacturing-capacity',
                'excerpt' => 'Our company announces the opening of a new state-of-the-art manufacturing facility to meet growing demand for our products.',
                'content' => $this->getNewFacilityContent(),
                'blog_category_id' => $companyNews->id,
                'featured_image' => 'blogs/new-facility.jpg',
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::now()->subDays(7),
                'meta_title' => 'CompressorLTD Expands Manufacturing Capacity with New Facility',
                'meta_description' => 'CompressorLTD announces the opening of a new state-of-the-art manufacturing facility to meet growing demand for industrial compressors.',
                'meta_keywords' => 'manufacturing expansion, new facility, compressor production, industrial equipment',
            ],
            [
                'title' => 'CompressorLTD Receives Industry Excellence Award for Energy Efficiency',
                'slug' => 'compressorltd-receives-industry-excellence-award',
                'excerpt' => 'Our company has been recognized with the prestigious Industry Excellence Award for our innovations in energy-efficient compressor technology.',
                'content' => $this->getAwardContent(),
                'blog_category_id' => $pressReleases->id,
                'featured_image' => 'blogs/award-ceremony.jpg',
                'status' => 'published',
                'featured' => true,
                'published_at' => Carbon::now()->subDays(14),
                'meta_title' => 'CompressorLTD Receives Industry Excellence Award for Energy Efficiency',
                'meta_description' => 'CompressorLTD has been recognized with the prestigious Industry Excellence Award for innovations in energy-efficient compressor technology.',
                'meta_keywords' => 'industry award, energy efficiency, compressor technology, sustainability award',
            ],
            [
                'title' => 'Join Us at the International Machinery Expo 2023',
                'slug' => 'join-us-international-machinery-expo-2023',
                'excerpt' => 'CompressorLTD will be showcasing our latest innovations at the International Machinery Expo. Visit our booth to see live demonstrations and meet our experts.',
                'content' => $this->getExpoContent(),
                'blog_category_id' => $events->id,
                'featured_image' => 'blogs/machinery-expo.jpg',
                'status' => 'published',
                'featured' => false,
                'published_at' => Carbon::now()->subDays(3),
                'meta_title' => 'Join CompressorLTD at the International Machinery Expo 2023',
                'meta_description' => 'Visit CompressorLTD at the International Machinery Expo 2023 to see our latest compressor innovations and meet our engineering team.',
                'meta_keywords' => 'machinery expo, trade show, compressor demonstration, industry event',
            ],
        ];

        foreach ($newsHeadlines as $postData) {
            Blog::firstOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );
        }
    }

    private function getNewFacilityContent()
    {
        return '<h2>CompressorLTD Doubles Production Capacity with New Manufacturing Facility</h2>

<p>We are pleased to announce the opening of our new state-of-the-art manufacturing facility, representing a significant milestone in our company\'s growth strategy. The 120,000 square foot facility will more than double our production capacity and create over 100 new jobs in the region.</p>

<h3>Strategic Expansion</h3>

<p>The new facility, located in the Westridge Industrial Park, features advanced automation systems, enhanced quality control processes, and improved energy efficiency throughout the production line. This expansion comes in response to growing demand for our industrial compressor solutions across North America and international markets.</p>

<p>"This investment represents our commitment to meeting the needs of our customers while maintaining the highest standards of quality and reliability," said John Anderson, CEO of CompressorLTD. "The additional capacity will allow us to reduce lead times and expand our product offerings to serve new market segments."</p>

<h3>Technological Advancements</h3>

<p>The facility incorporates several technological innovations:</p>

<ul>
<li>Automated assembly lines with real-time quality verification</li>
<li>Advanced testing chambers for performance validation under various conditions</li>
<li>Integrated inventory management systems</li>
<li>Renewable energy systems including rooftop solar panels</li>
</ul>

<h3>Environmental Considerations</h3>

<p>In line with our commitment to sustainability, the new facility has been designed to minimize environmental impact. Features include:</p>

<ul>
<li>LEED Gold certification for the building design</li>
<li>30% reduction in energy consumption compared to traditional manufacturing facilities</li>
<li>Water recycling systems that reduce consumption by up to 60%</li>
<li>Zero-waste initiatives for packaging and production materials</li>
</ul>

<h3>Community Impact</h3>

<p>The expansion will have a significant positive impact on the local economy, with the creation of jobs across various skill levels, from production line workers to engineers and management positions. The company has also established partnerships with local technical colleges to develop training programs that will prepare workers for careers in advanced manufacturing.</p>

<h3>Grand Opening</h3>

<p>A grand opening ceremony is scheduled for next month, with tours available for customers, partners, and community members. The facility is expected to be fully operational by the end of the quarter, with production gradually ramping up to full capacity over the following six months.</p>

<p>For more information about our expansion or to schedule a tour of the new facility, please contact our communications department.</p>';
    }

    private function getAwardContent()
    {
        return '<h2>CompressorLTD Recognized for Excellence in Energy-Efficient Technology</h2>

<p>CompressorLTD is proud to announce that we have been awarded the prestigious Industry Excellence Award for our innovations in energy-efficient compressor technology. The award, presented at the annual Industrial Energy Conference, recognizes companies that have made significant contributions to reducing energy consumption and environmental impact in industrial applications.</p>

<h3>Award-Winning Innovation</h3>

<p>The award specifically recognizes our new EcoForce Series of variable speed compressors, which deliver up to 45% energy savings compared to conventional fixed-speed systems. The EcoForce Series incorporates several groundbreaking technologies:</p>

<ul>
<li>Advanced motor control algorithms that optimize performance across varying loads</li>
<li>Intelligent pressure management that maintains precise pressure levels while minimizing energy use</li>
<li>Heat recovery systems that capture and repurpose up to 90% of waste heat</li>
<li>Predictive maintenance capabilities that ensure optimal efficiency throughout the equipment lifecycle</li>
</ul>

<h3>Industry Impact</h3>

<p>"CompressorLTD has demonstrated exceptional leadership in addressing one of the most significant challenges facing industrial operations today – energy efficiency," said Dr. Elizabeth Chen, chair of the award committee. "Their innovations are not only reducing costs for their customers but are making a meaningful contribution to global sustainability goals."</p>

<p>Independent testing has verified that facilities implementing the EcoForce Series typically achieve payback periods of less than 18 months through energy savings alone, with additional benefits from reduced maintenance costs and extended equipment life.</p>

<h3>Customer Success Stories</h3>

<p>The award submission included case studies from several customers who have implemented the EcoForce technology:</p>

<ul>
<li>A food processing plant reduced energy consumption by 42% while improving production reliability</li>
<li>An automotive manufacturing facility saved over $175,000 annually in energy costs</li>
<li>A pharmaceutical company achieved both energy savings and improved air quality for sensitive production processes</li>
</ul>

<h3>Commitment to Ongoing Innovation</h3>

<p>"This recognition reflects the dedication of our engineering team and their relentless pursuit of efficiency improvements," said Michael Roberts, Chief Technology Officer at CompressorLTD. "We see this not as a destination but as a milestone in our ongoing journey to develop increasingly sustainable solutions for our customers."</p>

<p>The company has announced that it will reinvest a significant portion of its R&D budget into further advancing energy-efficient technologies, with several new innovations already in the development pipeline.</p>

<h3>About the Industry Excellence Awards</h3>

<p>The Industry Excellence Awards are presented annually to recognize outstanding achievements in industrial innovation, sustainability, and operational excellence. Winners are selected through a rigorous evaluation process that includes technical assessment, customer validation, and demonstrated market impact.</p>

<p>For more information about our award-winning EcoForce Series or to schedule a consultation to evaluate potential energy savings for your facility, please contact our sales department.</p>';
    }

    private function getExpoContent()
    {
        return '<h2>CompressorLTD to Showcase Latest Innovations at International Machinery Expo 2023</h2>

<p>We are excited to announce our participation in the upcoming International Machinery Expo 2023, where we will be demonstrating our latest compressor technologies and solutions. This premier industry event will take place from September 15-18 at the Metropolitan Convention Center.</p>

<h3>Booth Highlights</h3>

<p>Visitors to Booth #4275 in the Industrial Equipment Hall will have the opportunity to experience:</p>

<ul>
<li><strong>Live Demonstrations:</strong> See our new EcoForce Series in action, with real-time energy consumption monitoring</li>
<li><strong>Interactive Displays:</strong> Explore the internal components and technologies through augmented reality interfaces</li>
<li><strong>ROI Calculator:</strong> Work with our experts to calculate potential energy savings for your specific application</li>
<li><strong>New Product Unveiling:</strong> Be among the first to see our newest innovation (to be revealed on Day 2 of the expo)</li>
</ul>

<h3>Expert Presentations</h3>

<p>Our team will be delivering several educational presentations throughout the event:</p>

<ul>
<li><strong>September 15, 11:00 AM:</strong> "Maximizing Compressor Efficiency in Manufacturing Environments" - Michael Roberts, CTO</li>
<li><strong>September 16, 2:30 PM:</strong> "The Future of Smart Compressors: IoT and Predictive Maintenance" - Sarah Johnson, Head of Digital Solutions</li>
<li><strong>September 17, 10:00 AM:</strong> "Case Study: Energy Savings in Food Processing Applications" - David Martinez, Applications Engineer</li>
</ul>

<h3>One-on-One Consultations</h3>

<p>Attendees can schedule personal consultations with our engineering team to discuss specific challenges and requirements. These sessions will provide an opportunity to:</p>

<ul>
<li>Review your current compressed air system performance</li>
<li>Identify potential efficiency improvements</li>
<li>Discuss customization options for specialized applications</li>
<li>Explore financing and service package options</li>
</ul>

<h3>Special Expo Offers</h3>

<p>We will be offering several exclusive promotions for orders placed during the expo:</p>

<ul>
<li>Extended warranty packages at no additional cost</li>
<li>Complimentary energy audit for your facility</li>
<li>Discounted preventive maintenance packages</li>
<li>Special financing terms for qualifying purchases</li>
</ul>

<h3>Registration Information</h3>

<p>The International Machinery Expo is open to industry professionals and requires registration. Use our promotional code COMPLTD23 when registering online to receive a 15% discount on admission.</p>

<h3>Connect With Us</h3>

<p>Can\'t wait until the expo? Contact our team today to schedule your appointment or to learn more about our participation in this event. We look forward to demonstrating how our solutions can help optimize your operations and reduce your energy costs.</p>

<p>We hope to see you at Booth #4275!</p>';
    }
}