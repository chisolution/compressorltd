# Project Plan for Compressor Ltd

## Composer Issues on Windows

When running Composer commands on Windows, you may encounter issues related to Git Bash. This is because Git Bash is not a native Windows shell and has some differences in its behavior compared to PowerShell.
there are several issues that can occur when running Composer commands in Git Bash on Windows:

Path Issues: Git Bash uses a Unix-like path format, while Windows uses backslashes. This can cause problems with Composer which may not properly handle the path conversion.
Character Encoding: Git Bash and Windows PowerShell use different character encodings, which can cause issues with special characters in package names or paths.
Process Handling: Git Bash's process handling is different from PowerShell, which can cause issues with long-running Composer commands or interactive prompts.
File System Case Sensitivity: Windows file systems are case-insensitive, but Git Bash may treat paths as case-sensitive, causing issues with autoloading and file detection.
Environment Variables: Git Bash may not properly inherit or set Windows environment variables needed by Composer.
PowerShell, being a native Windows shell, doesn't have these issues and is therefore recommended for running Composer commands on Windows systems.

## Project Overview

This project involves developing a Laravel 12.x website for Compressor Ltd, a company specializing in the sales of compressors, generators, and inverters. The website will showcase products without displaying prices and will use a contact form for purchase inquiries. The technology stack includes Laravel 12.x, Tailwind CSS 4.x, SASS, Vite, and MySQL.

## Project Scope

### In Scope
- Responsive website with multiple pages (Home, About, Products, Blog, Contact, Privacy Policy, Warranty)
- Product catalog with detailed specifications
- Blog functionality
- Contact form with product inquiry capability
- "Get a Free Quote" modal form on homepage and throughout the site
- Company information display in footer and contact page
- Modern, beautiful UI design focused on user convenience
- Admin panel for content management
- Responsive design for all devices
- SEO optimization

### Out of Scope
- E-commerce functionality (online payments, shopping cart)
- User accounts for customers
- Live chat functionality
- Multi-language support (initial version)
- Integration with third-party systems

## Technical Architecture

### Frontend
- HTML5, CSS3, JavaScript
- Tailwind CSS for styling
- SASS for CSS preprocessing
- Vite for asset bundling
- Responsive design principles
- Alpine.js for interactive components

### Backend
- Laravel 12.x framework
- MySQL database
- MVC architecture
- Laravel Blade templating
- Form validation and processing

### Infrastructure
- Shared hosting or VPS
- Apache or Nginx web server
- PHP 8.1+
- MySQL 8.0+
- SSL certificate

## Database Schema

### Tables
1. **users**
   - id (primary key)
   - name
   - email
   - password
   - role (admin, editor)
   - timestamps

2. **products**
   - id (primary key)
   - name
   - slug
   - category_id (foreign key)
   - short_description
   - long_description
   - specifications (JSON)
   - price (not displayed publicly)
   - sale_price (not displayed publicly)
   - discount_percentage
   - discount_amount
   - is_on_sale (boolean)
   - featured (boolean)
   - image_path
   - timestamps

3. **categories**
   - id (primary key)
   - name
   - slug
   - description
   - parent_id (for subcategories)
   - timestamps

4. **product_images**
   - id (primary key)
   - product_id (foreign key)
   - image_path
   - is_primary (boolean)
   - sort_order
   - timestamps

5. **inquiries**
   - id (primary key)
   - name
   - email
   - phone
   - product_id (foreign key, nullable)
   - message
   - status (new, contacted, closed)
   - timestamps

6. **blog_posts**
   - id (primary key)
   - title
   - slug
   - content
   - excerpt
   - author_id (foreign key)
   - featured_image
   - published_at
   - timestamps

7. **blog_categories**
   - id (primary key)
   - name
   - slug
   - timestamps

8. **blog_post_category** (pivot table)
   - blog_post_id (foreign key)
   - blog_category_id (foreign key)

9. **pages**
   - id (primary key)
   - title
   - slug
   - content
   - meta_description
   - meta_keywords
   - timestamps

10. **sliders**
    - id (primary key)
    - title
    - description
    - button_text
    - button_link
    - image_path
    - sort_order
    - is_active
    - timestamps

11. **quotation_requests**
    - id (primary key)
    - name
    - email
    - phone
    - company (nullable)
    - product_interest
    - message
    - status (new, processing, completed)
    - timestamps

12. **company_information**
    - id (primary key)
    - name
    - address
    - phone
    - email
    - map_coordinates (nullable)
    - is_headquarters (boolean)
    - is_active (boolean)
    - sort_order
    - timestamps

13. **email_configurations**
    - id (primary key)
    - email
    - name
    - is_active (boolean)
    - receive_inquiries (boolean)
    - receive_quotes (boolean)
    - receive_contact (boolean)
    - timestamps

## Implementation Plan

### Phase 1: Project Setup and Foundation (Week 1) - COMPLETED
- ✅ Set up development environment
- ✅ Initialize Laravel 12.x project with required packages
- ✅ Configure database connection
- ✅ Configure email sending functionality
- ✅ Create basic layout templates
- ✅ Implement Tailwind CSS 4.x and SASS with Vite
- ⏳ Set up authentication system (In progress)

### Phase 2: Database and Models (Week 2)
- Create database migrations
- Implement Eloquent models
- Set up relationships between models
- Create seeders for testing data
- Implement repositories/services for data access

### Phase 3: Admin Panel (Week 3)
- Implement admin dashboard
- Create CRUD functionality for products
- Implement category management
- Create blog post management
- Implement slider management
- Set up user management
- Create email configuration management

### Phase 4: Frontend - Core Pages (Week 4)
- Implement homepage with slider and "Get a Free Quote" button
- Create about us page
- Implement contact page with form
- Create privacy policy and warranty pages
- Implement responsive navigation
- Create company information display in footer
- Implement "Get a Free Quote" modal with form

### Phase 5: Frontend - Product Features (Week 5)
- Implement product listing page with filters
- Create product detail page
- Implement "Buy Now" functionality with contact form
- Create product search functionality
- Implement related products feature

### Phase 6: Form Handling and Email Notifications (Week 6)
- Implement form submission storage in database
- Create email notification system for form submissions
- Implement email configuration management in admin panel
- Create form validation and error handling
- Implement spam protection for forms

### Phase 7: Testing and Refinement (Week 7)
- Conduct cross-browser testing
- Test responsive design on various devices
- Perform performance optimization
- Implement SEO best practices
- Fix bugs and refine UI/UX

### Phase 8: Blog Functionality (Week 8)
- Implement blog listing page
- Create blog post detail page
- Implement blog categories and filtering
- Create recent posts widget
- Implement blog search functionality

### Phase 9: Deployment and Documentation (Week 9)
- Prepare production environment
- Deploy application
- Create user documentation
- Provide admin training
- Conduct final testing in production environment

## Testing Strategy

- Unit testing for core functionality
- Feature testing for key user flows
- Browser testing across major browsers (Chrome, Firefox, Safari, Edge)
- Mobile testing on iOS and Android devices
- Performance testing using tools like Lighthouse
- Security testing for common vulnerabilities

## Deployment Strategy

1. **Staging Deployment**
   - Deploy to staging environment
   - Conduct final testing
   - Client review and approval

2. **Production Deployment**
   - Database migration
   - Code deployment
   - Asset optimization
   - SSL configuration
   - DNS configuration

3. **Post-Deployment**
   - Monitoring for issues
   - Performance tracking
   - Backup implementation

## Maintenance Plan

- Regular security updates
- Periodic feature enhancements
- Content updates as needed
- Performance monitoring
- Regular backups
- Bug fixing as required
