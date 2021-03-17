FROM phusion/passenger-ruby22
MAINTAINER "boik@tdohacker.org"

ENV HOME /root
ENV RAILS_ENV production

CMD ["/sbin/my_init"]

# Bundle for cache
WORKDIR /tmp
ADD Gemfile Gemfile
ADD Gemfile.lock Gemfile.lock
RUN bundle install

RUN rm -f /etc/service/nginx/down
RUN rm /etc/nginx/sites-enabled/default

# Configure
ADD nginx.conf /etc/nginx/sites-enabled/level2.conf
ADD rails-env.conf /etc/nginx/main.d/rails-env.conf

# Install sudo
RUN apt-get update \
    && apt-get install -y sudo

ADD . /home/app/level2
WORKDIR /home/app/level2
RUN chown -R app:app /home/app/level2
RUN sudo -u app RAILS_ENV=production bundle exec rake assets:precompile --trace

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
