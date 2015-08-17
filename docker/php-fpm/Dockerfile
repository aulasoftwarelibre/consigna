FROM phusion/baseimage

MAINTAINER Sergio Gómez <sergio@uco.es>

EXPOSE 9000

RUN apt-get update && apt-get install -y php5-common php5-cli php5-fpm php5-mcrypt php5-mysql php5-apcu php5-gd php5-imagick php5-curl php5-intl
RUN apt-get install -y python-pyclamd

# Scripts
RUN mkdir -p /etc/my_init.d
ADD scripts/deploy.sh /etc/my_init.d/deploy.sh
# Services
RUN mkdir /etc/service/php-fpm
ADD scripts/php-fpm.sh /etc/service/php-fpm/run
# Change clamdscan
ADD scripts/clamdscan.py /usr/bin/clamdscan

ADD symfony.ini /etc/php5/fpm/conf.d/
ADD symfony.ini /etc/php5/cli/conf.d/
ADD symfony.pool.conf /etc/php5/fpm/pool.d/

RUN usermod -u 1000 www-data

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*