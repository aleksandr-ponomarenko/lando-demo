FROM devwithlando/php:8.3-apache-5

USER root

# Install Node.js 20.x and additional tools
RUN curl -fsSL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh \
    && bash nodesource_setup.sh \
    && apt-get update \
    && apt-get install --no-install-recommends -y mc net-tools iputils-ping python3 nodejs \
    && rm -rf /var/lib/apt/lists/* \
    && npm install -g npm yarn

USER www-data

RUN ln -sf /app/.lando/git-completion.bash /var/www/.git-completion.bash \
    && ln -sf /app/.lando/git-prompt.sh /var/www/.git-prompt.sh \
    && ln -sf /app/.lando/bashrc /var/www/.bashrc

USER root
