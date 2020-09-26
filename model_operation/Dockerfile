FROM ubuntu:18.04

RUN apt-get update
RUN apt-get install php -y

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

CMD [ "php", "-a" ]