FROM centos/php-71-centos7
ENV MY_VERSION 1.0
RUN mkdir -p /opt/app-root/src/server
COPY . /opt/app-root/src/server
WORKDIR /opt/app-root/src
VOLUME /opt/app-root/src
EXPOSE 8080
CMD ["php", "/opt/app-root/src/server/server.php"]