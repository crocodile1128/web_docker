FROM tutum/lamp:latest
RUN rm -rf /app
COPY ./xss /app/
COPY ./mysql.sh /
EXPOSE 80 3306
CMD ["/run.sh"] 
