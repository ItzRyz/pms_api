FROM php:8.2-fpm

# Install PostgreSQL extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Set the working directory
WORKDIR /app

# Copy the project files
COPY . .

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
