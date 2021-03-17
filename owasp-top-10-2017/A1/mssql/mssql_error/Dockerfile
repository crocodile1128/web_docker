FROM merorafael/php-apache:7.1
LABEL maintainer="Boik Su <boik@tdohacker.org>"

RUN apt-get update \
    && apt-get install -y apt-transport-https \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/8/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql

# https://github.com/Microsoft/msphpsql/issues/161#issuecomment-254046975
RUN apt-get install -y locales \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen

ADD . /var/www/html/
