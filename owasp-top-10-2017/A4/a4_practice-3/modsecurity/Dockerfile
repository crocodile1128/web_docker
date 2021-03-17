FROM owasp/modsecurity:v3-ubuntu-nginx

ENV PARANOIA=1

RUN apt-get update

RUN apt-get install -y python git

RUN cd /etc/nginx/modsecurity.d/ && \
  git clone -b v3.2/dev https://github.com/SpiderLabs/owasp-modsecurity-crs owasp-modsecurity-crs-3.2 && \
  mv /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/crs-setup.conf.example /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/crs-setup.conf && \
  echo "include /etc/nginx/modsecurity.d/modsecurity.conf\ninclude /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/crs-setup.conf\ninclude /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/rules/*.conf" > include.conf && \
  sed -i -e 's/SecRuleEngine DetectionOnly/SecRuleEngine On/g' /etc/nginx/modsecurity.d/modsecurity.conf && \
  rm /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/rules/REQUEST-941-APPLICATION-ATTACK-XSS.conf && \
  rm /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/rules/REQUEST-920-PROTOCOL-ENFORCEMENT.conf && \
  rm /etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/rules/REQUEST-942-APPLICATION-ATTACK-SQLI.conf

COPY docker-entrypoint.sh /

EXPOSE 80

ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["/usr/local/nginx/nginx", "-g", "daemon off;"]
