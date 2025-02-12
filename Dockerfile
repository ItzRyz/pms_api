FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Set the working directory
WORKDIR /app

# Copy project files
COPY . .

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

# Expose port 8000
EXPOSE 8000