# Production Deployment Guide

This is the production deployment branch for the Compressor Ltd Laravel application.

## Branch Purpose

This `production` branch contains only the essential files needed for deployment, excluding:
- Development dependencies (`node_modules/`, `vendor/`)
- Test files (`tests/`)
- Planning documents (`planning/`)
- Database files (`*.sqlite`, `*.db`)
- Environment files (`.env*`)
- Build artifacts (`public/build/`, `public/hot/`)
- Cache and log files
- IDE configuration files

## Deployment Steps

### 1. Server Setup
```bash
# Clone the production branch
git clone -b production https://github.com/chisolution/compressorltd.git
cd compressorltd

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm install

# Build frontend assets
npm run build
```

### 2. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database settings in .env
# Set APP_ENV=production
# Set APP_DEBUG=false
```

### 3. Database Setup
```bash
# Run migrations
php artisan migrate --force

# Seed initial data (optional)
php artisan db:seed --class=SiteSettingsSeeder
php artisan db:seed --class=AdminUserSeeder
```

### 4. Storage and Permissions
```bash
# Create storage symlink
php artisan storage:link

# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 5. Optimization (Production)
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

## File Structure

### Included Files:
- `app/` - Application logic
- `config/` - Configuration files
- `database/migrations/` - Database migrations
- `database/seeders/` - Database seeders
- `resources/` - Frontend assets and views
- `routes/` - Application routes
- `public/` - Web server document root (excluding build artifacts)
- `composer.json` - PHP dependencies
- `package.json` - Node.js dependencies
- Configuration files (Vite, Tailwind, etc.)

### Excluded Files:
- `tests/` - Unit and feature tests
- `planning/` - Development documentation
- `vendor/` - PHP dependencies (installed via composer)
- `node_modules/` - Node.js dependencies (installed via npm)
- `storage/logs/` - Log files
- Database files and environment files

## Important Notes

1. **Never commit sensitive data** like `.env` files to this branch
2. **Database files are excluded** - use migrations and seeders for database setup
3. **Build assets on deployment** - `public/build/` is excluded and built during deployment
4. **Install dependencies on server** - `vendor/` and `node_modules/` are excluded
5. **Configure environment** - Copy `.env.example` and configure for production

## Updating Production

To update the production branch with changes from main:

```bash
# Switch to main branch
git checkout main

# Pull latest changes
git pull origin main

# Switch to production branch
git checkout production

# Merge changes from main (resolve conflicts if any)
git merge main

# Push updated production branch
git push origin production
```

## Security Considerations

- Ensure `.env` file is properly configured with production values
- Set `APP_DEBUG=false` in production
- Use strong database credentials
- Configure proper file permissions
- Enable HTTPS in production
- Configure proper backup procedures
