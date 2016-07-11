FROM tutum/lamp:latest
RUN rm -fr /app
COPY . /app
EXPOSE 80 3306
CMD ["/run.sh"]
RUN php /app/bootstrap.php
