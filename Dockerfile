FROM tutum/lamp:latest
RUN rm -fr /app
COPY . /app
EXPOSE 80 3306
RUN echo extension=mcrypt.so
CMD ["/run.sh"]
ONBUILD RUN php /app/bootstrap.php
