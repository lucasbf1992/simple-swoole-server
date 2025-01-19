FROM php:8.1-cli


# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    libnghttp2-dev \
    libbrotli-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar e habilitar o Swoole
RUN pecl install swoole \
    && docker-php-ext-enable swoole

