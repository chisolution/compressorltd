# UI/UX Design Guidelines

## Design Principles

1. **Clean and Professional**
   - Use a clean, minimalist design that emphasizes product images and specifications
   - Maintain consistent spacing and alignment throughout the site
   - Use a professional color scheme that conveys reliability and quality

2. **User-Centered**
   - Design with the user's goals in mind (finding products, getting information, contacting the company)
   - Ensure all important actions are easily accessible
   - Minimize the number of clicks required to reach important information

3. **Responsive**
   - Ensure all pages work well on desktop, tablet, and mobile devices
   - Use flexible layouts that adapt to different screen sizes
   - Ensure touch targets are appropriately sized for mobile users

4. **Consistent**
   - Maintain consistent navigation, header, and footer across all pages
   - Use consistent typography and color schemes
   - Ensure UI elements behave predictably across the site

5. **Modern and Beautiful**
   - Implement contemporary design trends that appeal to the target audience
   - Use subtle animations and transitions to enhance user experience
   - Incorporate high-quality imagery and graphics
   - Ensure visual hierarchy guides users to important elements

6. **User Convenience**
   - Prioritize ease of use and intuitive navigation
   - Implement shortcuts for common actions
   - Ensure forms are easy to complete with minimal effort
   - Provide clear feedback for all user interactions

## Color Scheme

- **Primary Color**: Teal green (#33c4aa) - Main brand color, RGB(51, 196, 170) - Conveys reliability, freshness, and environmental consciousness
- **Secondary Color**: Blue-teal (#41b4d1) - Complementary to the primary color, creates a harmonious palette
- **Accent Color**: Darker teal (#2a9d8f) - For highlighting important elements and creating depth
- **Call-to-action Color**: Bright teal (#20d9c2) - For buttons and important interactive elements
- **Neutral Colors**:
  - Off-white (#f7f9fc) for backgrounds
  - Charcoal (#2d3748) for text
  - Pure white (#ffffff) for content areas
  - Light gray (#e2e8f0) for borders and dividers
  - Very light teal (#e6f7f5) for secondary backgrounds

## Typography

- **Headings**: Poppins (sans-serif), semi-bold and bold weights
- **Body Text**: Inter (sans-serif), regular and medium weights
- **Accent Text**: Poppins (sans-serif), medium weight
- **Font Sizes**:
  - Large headings: 36-48px (responsive)
  - Headings: 24-32px (responsive)
  - Subheadings: 18-24px (responsive)
  - Body text: 16px (responsive)
  - Small text: 14px (responsive)
  - Micro text: 12px (responsive)
- **Line Heights**:
  - Headings: 1.2
  - Body text: 1.6
- **Letter Spacing**:
  - Headings: -0.5px
  - Body text: 0

## Layout Guidelines

1. **Header**
   - Logo on the left
   - Main navigation in the center/right
   - Contact information or call-to-action button on the far right
   - Sticky on scroll for easy navigation

2. **Footer**
   - Company information and contact details
   - Secondary navigation
   - Social media links
   - Copyright information
   - Privacy policy and terms links

3. **Page Title Area**
   - Consistent height across all pages
   - Page title prominently displayed
   - Breadcrumb navigation
   - Background image or color that relates to the page content

4. **Content Areas**
   - Generous white space around content
   - Clear visual hierarchy with headings and subheadings
   - Content width limited to improve readability (max 1200px)
   - Consistent padding and margins

## Component Design

1. **Product Cards**
   - Consistent size and layout with subtle shadow that elevates on hover
   - Product image prominently displayed with hover zoom effect (scale 1.05)
   - Product name clearly visible with distinctive typography
   - "Read More" button in a consistent location
   - Hover effects and animations:
     - Card rises slightly (transform: translateY(-5px))
     - Shadow deepens on hover
     - Background color shifts slightly
     - "Read More" button changes color with smooth transition
     - Smooth transition effects (0.3s ease-in-out)
   - Sale badge with animated background gradient
   - Stylish hover state with teal border accent (#33c4aa)
   - Full width design with responsive sizing

2. **Buttons**
   - Primary buttons: Teal green background (#33c4aa) with white text and subtle shadow
   - Secondary buttons: Outlined style with darker teal color (#2a9d8f)
   - Call-to-action buttons: Bright teal background (#20d9c2) for high-priority actions
   - Consistent padding (16px 24px) and border-radius (8px)
   - Clear hover and active states with smooth transitions (darken by 10% on hover)
   - Icon+text combinations for enhanced clarity
   - Disabled state with reduced opacity (0.6)

3. **Forms**
   - Clean, modern styling with adequate spacing
   - Floating labels that animate on focus
   - Validation feedback inline with fields using color and icons
   - Required fields clearly marked
   - Submit buttons follow button styling guidelines
   - Success and error states clearly indicated with animations
   - Autofocus on first field when forms appear

4. **Navigation**
   - Clear current page indication with underline or highlight
   - Dropdown menus for categories with smooth animations
   - Mobile navigation collapses to hamburger menu
   - Smooth transitions between states
   - Sticky navigation on scroll with subtle shadow

5. **Modals**
   - Clean, focused design with subtle entrance/exit animations
   - Overlay background with blur effect
   - Clear close button in consistent location
   - Responsive sizing based on content and screen size
   - Focus trap for accessibility
   - ESC key to close
   - Form elements follow form styling guidelines

## Page-Specific Guidelines

1. **Homepage**
   - Hero slider with 4 slides highlighting key products or messages
   - Prominent "Get a Free Quote" button that opens a modal form
   - Featured products section with modern card layout
   - Brief company introduction with engaging visuals
   - Latest blog posts with thumbnail images
   - Testimonials or trust indicators
   - Call-to-action for contact
   - Animated statistics or company highlights

2. **Product Listing Page**
   - Advanced filtering options for product categories and specifications
   - Grid layout for product cards with consistent spacing (4 products per row on desktop)
   - Pagination showing 16 products per page
   - Sort options (A-Z, Z-A, Price: low to high, high to low, etc.)
   - Search functionality with auto-suggestions
   - Clear indication of current category
   - Quick view functionality for product details
   - Responsive grid that adjusts to 2 products per row on tablets and 1 per row on mobile
   - "Sale" badges prominently displayed on discounted products
   - Animated transitions when filtering or sorting products
   - Full width product cards that occupy entire available space

3. **Product Detail Page**
   - Large, high-quality product images with gallery functionality
   - Image zoom on hover
   - Short description prominently displayed below product name
   - Tabbed interface with:
     - Description tab (long description with formatted text)
     - Specifications tab (detailed specifications in a structured, easy-to-read format)
     - Features tab (bulleted list of features)
     - Documents tab (downloadable resources)
     - Related Products tab
   - Related products section with horizontal scroll on mobile
   - Prominent "Buy Now" button with subtle animation
   - Product inquiry form pre-filled with product information
   - Share buttons for social media
   - Breadcrumb navigation showing product category hierarchy

4. **Contact Page**
   - Modern contact form prominently displayed
   - Company address and contact information with icons
   - Interactive map showing all branch locations
   - Alternative contact methods clearly indicated
   - Branch/office listings with contact details
   - Business hours information
   - FAQ section for common inquiries

5. **Footer**
   - Company information including all branch locations
   - Contact details (phone, email)
   - Quick links to important pages
   - Newsletter signup
   - Social media links with recognizable icons
   - Copyright information
   - Privacy policy and terms links

6. **Quote Modal**
   - Clean, focused design with product selection options
   - Minimal required fields to reduce friction
   - Clear indication of next steps after submission
   - Mobile-friendly layout
   - Progress indicator for multi-step forms
   - Thank you message with follow-up information
