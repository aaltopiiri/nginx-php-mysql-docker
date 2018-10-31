FROM php:7.2-fpm

# System Dependencies.
RUN apt-get update && apt-get install -y \
		git \
		imagemagick \
		libicu-dev \
		# Required for SyntaxHighlighting
		python3 \
	--no-install-recommends && rm -r /var/lib/apt/lists/*

# Install the PHP extensions we need
RUN docker-php-source extract 
RUN docker-php-ext-install mbstring mysqli opcache intl pdo_mysql
RUN docker-php-source delete

# Install the default object cache.
RUN pecl channel-update pecl.php.net \
	&& pecl install apcu \
	&& docker-php-ext-enable apcu

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=60'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini