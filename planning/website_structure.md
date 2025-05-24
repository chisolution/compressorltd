# Website Structure for Compressor Ltd

This document outlines the structure and navigation for the Compressor Ltd website, including all pages, sections, and their relationships.

## Main Navigation

### Primary Navigation Items
1. **Home**
2. **Products**
   - Air Compressors
   - Generators
   - Inverters
3. **About Us**
4. **Blog**
5. **Contact**
6. **Warranty**
7. **Privacy Policy**

### Secondary Navigation (Footer)
1. **Quick Links**
   - Products
   - About Us
   - Contact
   - Warranty
   - Privacy Policy
2. **Company Information**
   - Address
   - Phone
   - Email
   - Hours
3. **Payment Methods**
4. **Social Media Links**
5. **Copyright Information**

## Page Structure

### 1. Home Page
- **Hero Section**
  - Slider with 4 slides featuring key products and services
  - "Get a Free Quote" button (opens modal form)
- **Featured Products Section**
  - 3-4 featured products with images and brief descriptions
  - "Read More" buttons linking to product detail pages
- **About Us Preview**
  - Brief company introduction
  - Image
  - "Read More" button linking to About Us page
- **Testimonials Section**
  - 3 customer testimonials with company names and logos
- **Latest Blog Posts**
  - 3 recent blog post previews
  - "Read More" buttons linking to full posts
- **Call to Action**
  - Contact information
  - "Contact Us" button

### 2. Products Overview Page
- **Page Title Area**
  - "Products" heading
  - Breadcrumb navigation
- **Product Categories**
  - Air Compressors (with image)
  - Generators (with image)
  - Inverters (with image)
  - Brief description for each category
  - "View Products" buttons linking to category pages

### 3. Product Category Pages (Air Compressors, Generators, Inverters)
- **Page Title Area**
  - Category name heading
  - Breadcrumb navigation
- **Category Description**
  - Overview of the product category
  - Key benefits and applications
- **Filter/Sort Options**
  - Filter by subcategory
  - Filter by specifications
  - Sort options (newest, popularity)
- **Product Grid**
  - 16 products per page, 4 products per row on desktop
  - Product cards with:
    - Product image
    - Product name
    - "Sale" badge with percentage off (if applicable)
    - "Read More" button
  - Animated hover effects on product cards
  - Full width product cards that occupy entire available space
- **Pagination**
  - Next/Previous buttons
  - Page numbers
  - Showing 16 products per page

### 4. Product Detail Pages
- **Page Title Area**
  - Product name heading
  - Breadcrumb navigation
- **Product Overview**
  - Product images (gallery with zoom functionality)
  - Product name and model
  - Short description
  - Key specifications highlights
  - "Buy Now" button (redirects to contact form)
- **Product Details**
  - Tabbed interface with:
    - Description (long description with formatted text)
    - Specifications (detailed table)
    - Features (bulleted list)
    - Applications
    - Documents (downloadable resources)
- **Related Products**
  - 3-4 related product cards
  - "View Details" buttons

### 5. About Us Page
- **Page Title Area**
  - "About Us" heading
  - Breadcrumb navigation
- **Company Overview**
  - Company history
  - Mission and vision
  - Core values
- **Team Section**
  - Key team members with photos and brief bios
- **Certifications and Partnerships**
  - Logos and descriptions of certifications
  - Manufacturer partnerships
- **Service Areas**
  - Map showing service regions
  - List of areas served

### 6. Blog Page
- **Page Title Area**
  - "Blog" heading
  - Breadcrumb navigation
- **Blog Filters**
  - Categories
  - Search functionality
- **Blog Post Grid**
  - Post cards with:
    - Featured image
    - Title
    - Publication date
    - Author
    - Brief excerpt
    - "Read More" button
- **Pagination**
  - Next/Previous buttons
  - Page numbers

### 7. Blog Post Detail Page
- **Page Title Area**
  - Blog post title
  - Breadcrumb navigation
- **Post Header**
  - Publication date
  - Author
  - Categories
- **Post Content**
  - Full article text
  - Images
  - Embedded videos (if applicable)
- **Share Buttons**
  - Social media sharing options
- **Related Posts**
  - 3 related blog post cards
- **Comments Section**
  - Comment form
  - Existing comments

### 8. Contact Page
- **Page Title Area**
  - "Contact Us" heading
  - Breadcrumb navigation
- **Contact Information**
  - Address
  - Phone numbers
  - Email addresses
  - Business hours
- **Contact Form**
  - Name field
  - Email field
  - Phone field
  - Subject field
  - Message field
  - Submit button
- **Map**
  - Interactive map showing location(s)
- **Branch Locations**
  - List of all branch locations with contact details

### 9. Warranty Page
- **Page Title Area**
  - "Warranty" heading
  - Breadcrumb navigation
- **Warranty Information**
  - Warranty terms and conditions
  - Coverage details
  - Claim process
- **FAQ Section**
  - Common warranty questions and answers
- **Contact Information**
  - Warranty support contact details

### 10. Privacy Policy Page
- **Page Title Area**
  - "Privacy Policy" heading
  - Breadcrumb navigation
- **Policy Content**
  - Information collection
  - Use of information
  - Data protection
  - Cookie policy
  - Third-party disclosure
  - User rights

## Modal Forms

### 1. "Get a Free Quote" Modal
- **Title**: Get a Free Quote
- **Form Fields**:
  - Name (required)
  - Email (required)
  - Phone (required)
  - Company Name (optional)
  - Product Interest (checkboxes for product categories)
  - Message (optional)
  - Submit button

### 2. "Buy Now" Contact Form
- **Title**: Request Information
- **Pre-filled Fields**:
  - Product Name
  - Product ID
- **User Input Fields**:
  - Name (required)
  - Email (required)
  - Phone (required)
  - Message (required)
  - Submit button

## Technical Structure

### URL Structure
- Homepage: `/`
- Products Overview: `/products`
- Product Categories: `/products/air-compressors`, `/products/generators`, `/products/inverters`
- Product Detail: `/products/air-compressors/{product-slug}`, `/products/generators/{product-slug}`, `/products/inverters/{product-slug}`
- About Us: `/about-us`
- Blog: `/blog`
- Blog Post: `/blog/{post-slug}`
- Contact: `/contact`
- Warranty: `/warranty`
- Privacy Policy: `/privacy-policy`

### Database Relationships
- Products belong to Categories
- Products have many Product Images
- Blog Posts belong to Blog Categories (many-to-many)
- Blog Posts belong to Users (authors)
- Inquiries may reference Products
- Quotation Requests may reference Products

### Admin Sections
- Dashboard
- User Management
- Product Management
- Category Management
- Inquiry Management
- Quotation Request Management
- Blog Management
- Content Management (sliders, pages)
- Email Configuration
