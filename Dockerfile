FROM webdevops/php-nginx:7.4

COPY ./docker /app/docker/

RUN cp -R /app/docker/config/supervisor/conf.d/* /opt/docker/etc/supervisor.d/
