FROM phusion/passenger-customizable:0.9.35
LABEL MAINTAINER "boik@tdohacker.org"

WORKDIR /home/app/challenge

# Use baseimage-docker's init process.
CMD ["/sbin/my_init"]

# Build system and install git & ruby-2.5.1.
RUN /pd_build/utilities.sh \
  && /pd_build/ruby-2.5.1.sh \
  && bash -lc 'rvm --default use ruby-2.5.1'

RUN apt-get update \
  && apt-get install -y sudo lxc tzdata

COPY Gemfile /home/app/challenge/
RUN gem install bundler \
  && gem update --system \
  && bundle install --jobs 40 --retry 10

# Enable the Nginx service.
RUN rm -f /etc/service/nginx/down \
  && rm /etc/nginx/sites-enabled/default

# Configure
ADD nginx.conf /etc/nginx/sites-enabled/challenge.conf

COPY . /home/app/challenge
RUN chown -R app:app /home/app/challenge \
  && sudo -u app bundle exec rails assets:precompile \
  && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
