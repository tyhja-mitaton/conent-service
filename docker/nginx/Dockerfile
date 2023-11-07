FROM nginx:latest

COPY docker/nginx/image-files/ /

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
#неработающие попытки передать в конфиг nginx константу из env
#CMD ["/bin/bash", "envsubst '${PARAMS_DEFAULT_DOMAIN_STATIC}' < common/docker/nginx/image-files/etc/nginx/conf.d/default.conf.temp > /etc/nginx/conf.d/default.conf"]

#CMD ["/bin/bash", "-c", "export PARAMS_DEFAULT_DOMAIN_STATIC && envsubst '$$PARAMS_DEFAULT_DOMAIN_STATIC' < common/docker/nginx/image-files/etc/nginx/conf.d/default.conf > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'"]
#envsubst '${MY_VARIABLE}' < common/docker/nginx/image-files/etc/nginx/conf.d/default.conf > /etc/nginx/conf.d/default.conf
