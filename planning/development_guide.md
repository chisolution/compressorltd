# Development Guide for Compressor Ltd Website

This guide provides instructions for working with the Compressor Ltd website project, which uses Laravel 12.x, Tailwind CSS 4.x, SASS, Vite, and MySQL.

## Technology Stack

- **Laravel**: Version 12.x (Latest)
- **Tailwind CSS**: Version 4.x
- **Vite**: For asset bundling
- **SASS**: For advanced CSS preprocessing
- **MySQL**: For database storage
- **PHP**: Version 8.2+

## Development Environment Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 16+ and NPM
- MySQL

### Initial Setup

1. Clone the repository:
   ```
   git clone https://github.com/chisolution/Compressor-Ltd.git
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install Node.js dependencies:
   ```
   npm install
   ```

4. Create a copy of the `.env.example` file:
   ```
   cp .env.example .env
   ```

5. Generate an application key:
   ```
   php artisan key:generate
   ```

6. Configure your database in the `.env` file.

7. Run migrations:
   ```
   php artisan migrate
   ```

## Development Workflow

### Running the Development Server

To start the Laravel development server and Vite for hot module replacement:

```
php artisan serve
```

In a separate terminal:

```
npm run dev
```

### Building Assets for Production

To build assets for production:

```
npm run build
```

This will create the necessary files in the `public/build` directory, including the `manifest.json` file that Laravel needs to locate your assets.

## Working with Tailwind 4.x

Tailwind 4.x has significant changes from previous versions:

1. It uses a new theme variables system with `@theme` directive
2. Custom colors are defined using CSS variables in the `--color-*` namespace
3. It requires the `@tailwindcss/postcss` package for PostCSS integration
4. The configuration format is simplified, with most customization done in CSS

**Example of defining custom colors in Tailwind 4.x**:

```css
@import "tailwindcss";

@theme {
  /* Custom colors */
  --color-primary: #33c4aa;
  --color-secondary: #41b4d1;
}
```

**Using custom colors in your CSS**:

```css
.my-element {
  color: var(--color-primary);
  background-color: var(--color-secondary);
}
```

**PostCSS Configuration for Tailwind 4.x**:

```js
export default {
  plugins: {
    '@tailwindcss/postcss': {},
    autoprefixer: {},
  },
}
```

**Important**: Always search the web to update your knowledge of how these versions work and for the latest implementation details. Your knowledge might be outdated (Laravel 10.x and Tailwind 3.x), so always check the official documentation.

## Common Issues and Solutions

### Vite Manifest Not Found Error

If you encounter the "Vite manifest not found" error, it means Laravel cannot find the compiled assets. This typically happens when:

1. You haven't run `npm run build` yet
2. The build process failed
3. The build directory is not accessible

**Solution**:
- Make sure to run `npm run build` before deploying or testing in production mode
- Check for any errors during the build process
- Verify that the `public/build` directory exists and contains a `manifest.json` file

### Composer Commands in GitBash

**Important**: Do not run Composer commands with GitBash terminal. Use PowerShell instead.

**Reason**: GitBash on Windows has path translation issues that can cause problems with Composer. GitBash converts Windows paths to Unix-style paths, which can confuse Composer when it's trying to resolve file paths.

**Solution**:
- Use PowerShell for Composer commands: `composer install`, `composer update`, etc.
- You can still use GitBash for Git commands and other terminal operations

## Best Practices

1. **Always Use Web Search for Implementation Details**:
   - Laravel 12 and Tailwind 4 are recent releases with evolving best practices
   - Always search for up-to-date implementation examples when adding features
   - Check official documentation frequently as it may be updated

2. **Version Control**:
   - Commit frequently with descriptive messages
   - Create feature branches for new functionality
   - Never commit sensitive information like API keys or credentials

3. **Testing**:
   - Write tests for new features
   - Run tests before committing changes
   - Use Laravel's built-in testing tools
   - Use PHP Test Units, make sure to use a test database for testing
   - Do not refresh the production or development database in tests

4. **Performance**:
   - Optimize database queries
   - Use Laravel's caching features when appropriate
   - Minimize JavaScript bundle size by avoiding unnecessary dependencies

## Project Structure

The project follows the standard Laravel 12.x structure with some additional directories:

```
Compressor/
├── app/                  # Application code
├── bootstrap/            # Framework bootstrap files
├── config/               # Configuration files
├── database/             # Database migrations and seeds
├── planning/             # Project planning documents
├── public/               # Publicly accessible files
├── resources/            # Frontend resources
│   ├── css/              # CSS files
│   ├── js/               # JavaScript files
│   ├── sass/             # SASS files
│   └── views/            # Blade templates
├── routes/               # Route definitions
├── storage/              # Application storage
├── tests/                # Test files
└── vendor/               # Composer dependencies
```

## Useful Resources

- [Laravel 12.x Documentation](https://laravel.com/docs/12.x)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/guide/)
- [Laravel Vite Plugin Documentation](https://laravel.com/docs/12.x/vite)

## Troubleshooting

When encountering issues, follow these steps:

1. Check the Laravel and server logs
2. Search for the specific error message online
3. Check GitHub issues for the relevant packages
4. Ask for help in Laravel communities (Laravel.io, Laracasts, Stack Overflow)

Remember to always keep dependencies updated and follow security best practices.

## Current Project Status

### Completed Features
- ✅ **Admin Dashboard**: Comprehensive admin panel with dark sidebar navigation
- ✅ **Product Management**: Full CRUD with multi-step forms, image uploads, and categories
- ✅ **Content Management**: Blog posts, sliders, contact forms, and newsletter management
- ✅ **Quote Request System**: Public quote requests with admin management
- ✅ **Professional Frontend**: Homepage, product catalog, and product detail pages
- ✅ **Responsive Design**: Mobile-first approach with professional UI/UX

### Key Features Implemented
- **Dynamic Hero Slider**: Admin-managed sliders with fallback to static content
- **Professional Product Catalog**: Enhanced search, filtering, and product cards
- **Quote Request Modal**: Product pre-fill with "Inquire Now" functionality
- **2-Column FAQ Section**: General information and common questions
- **Category Management**: Parent-child relationships with hierarchical display
- **Image Management**: Upload, storage, and optimization for products and sliders

### Technical Implementation
- **Framework**: Laravel 10.38 (Note: Documentation mentions 12.x but project uses 10.38)
- **Database**: MySQL with comprehensive schema for all features
- **Frontend**: Tailwind CSS with custom color scheme and professional styling
- **Authentication**: Laravel Breeze for admin-only access
- **File Storage**: Local storage with public disk for images

### Next Steps
- Dynamic slider integration with fallback system
- SEO optimization and meta tags
- Performance optimization and caching
- Additional content pages (About, Privacy Policy, etc.)
