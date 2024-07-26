# Utiliser l'image PHP avec FPM
FROM php:8.2-fpm

# Installer les dépendances et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        git \
        libicu-dev \
        libfreetype-dev \
    	libjpeg62-turbo-dev \
    	libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo pdo_mysql \
        zip \
        intl

RUN pecl install redis-5.3.7 \
	&& pecl install xdebug-3.2.1 \
	&& docker-php-ext-enable redis xdebug

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.7.0 --install-dir=/usr/local/bin --filename=composer

# Installer Node.js
RUN curl -sL https://deb.nodesource.com/setup_21.x | bash - && \
    apt-get install -y nodejs

# Installer Yarn
RUN npm install --global yarn

# Télécharger et installer le CLI Symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Définir le répertoire de travail
WORKDIR /var/www/jysa-radio

# Copier le code source de l'application dans le conteneur
COPY . /var/www/jysa-radio

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# Installer les dépendances de l'application via Composer
RUN composer install --no-interaction --no-scripts

# Exposer le port 9000
EXPOSE 9000

# Démarrer PHP-FPM
CMD ["php-fpm"]


