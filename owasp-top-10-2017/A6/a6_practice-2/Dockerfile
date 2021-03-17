FROM tiangolo/uwsgi-nginx:python2.7-alpine3.7
LABEL maintainer="Boik Su <boik@tdohacker.org>"

WORKDIR /app

ADD ./app .
RUN pip install -r requirements.txt
