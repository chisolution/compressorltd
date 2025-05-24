# Database Schema Design

## Overview of Compressor Ltd

This document outlines the database schema for the Compressor Ltd (compressor, inverter, and generator sales) website. The schema is designed to support all the required functionality while maintaining good database design practices.

## Tables

### 1. users
Stores user information for administrators and content managers.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | varchar(255) | NOT NULL | User's full name |
| email | varchar(255) | NOT NULL, UNIQUE | User's email address |
| email_verified_at | timestamp | NULL | When email was verified |
| password | varchar(255) | NOT NULL | Hashed password |
| remember_token | varchar(100) | NULL | For "remember me" functionality |
| role | varchar(20) | NOT NULL, DEFAULT 'editor' | User role (admin, editor) |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 2. categories
Stores product categories.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | varchar(255) | NOT NULL | Category name |
| slug | varchar(255) | NOT NULL, UNIQUE | URL-friendly name |
| description | text | NULL | Category description |
| parent_id | bigint | NULL, FOREIGN KEY | Parent category ID |
| image_path | varchar(255) | NULL | Category image |
| is_active | boolean | NOT NULL, DEFAULT true | Whether category is active |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 3. products
Stores product information.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| category_id | bigint | NOT NULL, FOREIGN KEY | Category ID |
| name | varchar(255) | NOT NULL | Product name |
| slug | varchar(255) | NOT NULL, UNIQUE | URL-friendly name |
| short_description | text | NULL | Short product description for listings |
| long_description | text | NULL | Detailed product description for product page |
| specifications | json | NULL | Product specifications |
| features | text | NULL | Product features |
| price | decimal(10,2) | NULL | Regular product price (not displayed) |
| sale_price | decimal(10,2) | NULL | Sale price if on sale (not displayed) |
| discount_percentage | decimal(5,2) | NULL | Discount percentage if applicable |
| discount_amount | decimal(10,2) | NULL | Discount amount if applicable |
| is_on_sale | boolean | NOT NULL, DEFAULT false | Whether product is on sale |
| is_featured | boolean | NOT NULL, DEFAULT false | Whether product is featured |
| is_active | boolean | NOT NULL, DEFAULT true | Whether product is active |
| meta_title | varchar(255) | NULL | SEO meta title |
| meta_description | text | NULL | SEO meta description |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 4. product_images
Stores product images.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| product_id | bigint | NOT NULL, FOREIGN KEY | Product ID |
| image_path | varchar(255) | NOT NULL | Path to image file |
| alt_text | varchar(255) | NULL | Alternative text for image |
| is_primary | boolean | NOT NULL, DEFAULT false | Whether this is the main product image |
| sort_order | int | NOT NULL, DEFAULT 0 | Order for display |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 5. inquiries
Stores customer inquiries from the contact form.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | varchar(255) | NOT NULL | Customer name |
| email | varchar(255) | NOT NULL | Customer email |
| phone | varchar(20) | NULL | Customer phone number |
| product_id | bigint | NULL, FOREIGN KEY | Related product ID |
| subject | varchar(255) | NULL | Inquiry subject |
| message | text | NOT NULL | Inquiry message |
| status | varchar(20) | NOT NULL, DEFAULT 'new' | Status (new, contacted, closed) |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 6. blog_categories
Stores blog post categories.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | varchar(255) | NOT NULL | Category name |
| slug | varchar(255) | NOT NULL, UNIQUE | URL-friendly name |
| description | text | NULL | Category description |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 7. blog_posts
Stores blog posts.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| user_id | bigint | NOT NULL, FOREIGN KEY | Author ID |
| title | varchar(255) | NOT NULL | Post title |
| slug | varchar(255) | NOT NULL, UNIQUE | URL-friendly name |
| excerpt | text | NULL | Short excerpt |
| content | text | NOT NULL | Post content |
| featured_image | varchar(255) | NULL | Featured image path |
| is_published | boolean | NOT NULL, DEFAULT false | Whether post is published |
| published_at | timestamp | NULL | When post was published |
| meta_title | varchar(255) | NULL | SEO meta title |
| meta_description | text | NULL | SEO meta description |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 8. blog_post_category
Pivot table for many-to-many relationship between blog posts and categories.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| blog_post_id | bigint | NOT NULL, FOREIGN KEY | Blog post ID |
| blog_category_id | bigint | NOT NULL, FOREIGN KEY | Blog category ID |

### 9. pages
Stores static pages like About Us, Privacy Policy, etc.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| title | varchar(255) | NOT NULL | Page title |
| slug | varchar(255) | NOT NULL, UNIQUE | URL-friendly name |
| content | text | NOT NULL | Page content |
| is_active | boolean | NOT NULL, DEFAULT true | Whether page is active |
| meta_title | varchar(255) | NULL | SEO meta title |
| meta_description | text | NULL | SEO meta description |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 10. sliders
Stores homepage slider content.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| title | varchar(255) | NOT NULL | Slider title |
| subtitle | varchar(255) | NULL | Slider subtitle |
| description | text | NULL | Slider description |
| image_path | varchar(255) | NOT NULL | Path to slider image |
| button_text | varchar(50) | NULL | Call-to-action button text |
| button_link | varchar(255) | NULL | Call-to-action button URL |
| is_active | boolean | NOT NULL, DEFAULT true | Whether slider is active |
| sort_order | int | NOT NULL, DEFAULT 0 | Order for display |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 11. quotation_requests
Stores requests for quotations from the "Get a Free Quote" modal form.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | varchar(255) | NOT NULL | Customer name |
| email | varchar(255) | NOT NULL | Customer email |
| phone | varchar(20) | NOT NULL | Customer phone number |
| company | varchar(255) | NULL | Customer company name |
| product_interest | text | NULL | Products customer is interested in |
| message | text | NULL | Additional message from customer |
| status | varchar(20) | NOT NULL, DEFAULT 'new' | Status (new, processing, completed) |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 12. company_information
Stores company information for display in footer and contact page.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | varchar(255) | NOT NULL | Branch/location name |
| address | text | NOT NULL | Physical address |
| phone | varchar(20) | NOT NULL | Contact phone number |
| email | varchar(255) | NOT NULL | Contact email |
| map_coordinates | varchar(255) | NULL | Google Maps coordinates |
| is_headquarters | boolean | NOT NULL, DEFAULT false | Whether this is the main office |
| is_active | boolean | NOT NULL, DEFAULT true | Whether to display this location |
| sort_order | int | NOT NULL, DEFAULT 0 | Order for display |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

### 13. email_configurations
Stores email configuration for form submissions.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| email | varchar(255) | NOT NULL | Email address to receive notifications |
| name | varchar(255) | NOT NULL | Recipient name |
| is_active | boolean | NOT NULL, DEFAULT true | Whether this email is active |
| receive_inquiries | boolean | NOT NULL, DEFAULT true | Whether to receive inquiry notifications |
| receive_quotes | boolean | NOT NULL, DEFAULT true | Whether to receive quote request notifications |
| receive_contact | boolean | NOT NULL, DEFAULT true | Whether to receive contact form notifications |
| created_at | timestamp | NULL | Creation timestamp |
| updated_at | timestamp | NULL | Update timestamp |

## Relationships

1. **categories**
   - A category can have many products (one-to-many)
   - A category can have a parent category (self-referential)
   - A category can have many child categories (self-referential)

2. **products**
   - A product belongs to one category (many-to-one)
   - A product can have many product images (one-to-many)
   - A product can have many inquiries (one-to-many)
   - A product can be referenced in many quotation requests (indirect)

3. **users**
   - A user can have many blog posts as an author (one-to-many)

4. **blog_posts**
   - A blog post belongs to one user as the author (many-to-one)
   - A blog post can have many blog categories (many-to-many)

5. **blog_categories**
   - A blog category can have many blog posts (many-to-many)

6. **quotation_requests**
   - A quotation request can reference multiple products (text field)

7. **company_information**
   - Company information entries are independent entities

8. **email_configurations**
   - Email configuration entries are independent entities

## Indexes

- Primary keys on all tables
- Foreign key indexes for all relationships
- Unique indexes on all slug fields
- Index on product.is_featured for quick retrieval of featured products
- Index on blog_post.is_published and blog_post.published_at for blog listing
- Index on inquiry.status for filtering inquiries by status
- Index on quotation_request.status for filtering quotation requests by status
- Index on company_information.is_headquarters for quickly finding the main office
- Index on company_information.is_active for filtering active locations
- Index on email_configurations.is_active for filtering active email recipients
