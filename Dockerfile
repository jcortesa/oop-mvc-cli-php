FROM php:8.4-cli

# Install required packages and locales
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    locales \
    && rm -rf /var/lib/apt/lists/* \
    && sed -i '/en_US.UTF-8/s/^# //g' /etc/locale.gen \
    && locale-gen

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set environment variables
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

# Install PDO MySQL extension
RUN docker-php-ext-install pdo_mysql

WORKDIR /app