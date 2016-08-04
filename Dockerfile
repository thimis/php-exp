FROM tutum/lamp:latest
RUN rm -fr /app
COPY . /app
EXPOSE 80 3306
RUN echo "extension=mcrypt.so" >> /etc/php5/apache2/php.ini
CMD ["/run.sh"]
