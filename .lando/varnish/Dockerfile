FROM varnish:7.5

# set the user to root, and install build dependencies
USER root
RUN mkdir -p /app
RUN set -e; \
    apt-get update; \
    apt-get -y install $VMOD_DEPS /pkgs/*.deb; \
    \
# install one, possibly multiple vmods
   install-vmod https://github.com/varnish/varnish-modules/releases/download/0.24.0/varnish-modules-0.24.0.tar.gz; \
    \
# clean up and set the user back to varnish
    apt-get -y purge --auto-remove $VMOD_DEPS varnish-dev; \
    rm -rf /var/lib/apt/lists/*

USER varnish

ARG CURRENT_ENV

COPY default.vcl /etc/varnish/default.vcl

CMD ["varnishd", "-F", "-f", "/etc/varnish/default.vcl", "-p", "http_req_hdr_len=16384", "-p", "http_resp_hdr_len=16384", "-s", "default,64M"]
