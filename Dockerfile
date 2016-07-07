FROM tutum/lamp:latest
RUN rm -fr /app
COPY . /app
EXPOSE 80 3306
CMD ["/run.sh"]
RUN npm install
RUN php /app/bootstrap.php
