
FROM debian:buster-slim
MAINTAINER Christophe Imbach / docker-lizmapdebian

ARG DEBIAN_FRONTEND=noninteractive

ENV MYAPP=lizmap-web-client    
ENV VERSION=3.1.12
ENV TIMEZONE=Europe/Zurich

RUN dpkg-divert --local --rename --add /sbin/initctl && \
    apt-get -y update && \
    apt-get install -y gnupg apt-transport-https ca-certificates nano vim apt-utils && \
    echo "alias lsa='ls -al -tr'" >> /root/.bashrc && \
    echo "alias lsd='ls -alh --group-directories-first'" >> /root/.bashrc && \
    echo "deb https://qgis.org/debian-ltr buster main" >> /etc/apt/sources.list.d/qgis.list && \
    echo "deb-src https://qgis.org/debian-ltr buster main" >> /etc/apt/sources.list.d/qgis.list && \
    apt-key adv --keyserver keyserver.ubuntu.com --recv-key CAEB3DC3BDF7FB45 && \
    apt-get -y update && \
    apt-get install -y apache2 libapache2-mod-fcgid \
    unzip xvfb locales tzdata xauth htop curl ntp ntpdate sudo \ 
    libapache2-mod-php7.3 php7.3-cgi php7.3-gd php7.3-sqlite php7.3-curl php7.3-xmlrpc python-simplejson software-properties-common \
    php7.3-simplexml && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    locale-gen fr_CH.UTF-8 && \
    dpkg-reconfigure locales && \
    unlink /etc/localtime && ln -s /usr/share/zoneinfo/$TIMEZONE /etc/localtime && \    
    useradd --create-home --shell /bin/bash lizmap  && echo "lizmap:lizmap" | chpasswd && \
    adduser lizmap sudo
         
USER lizmap
RUN echo 'lizmap' | sudo -S apt-get -y update && \
    sudo apt-get -y install qgis-server python-qgis && \
    mkdir /home/lizmap/QGIS_AUTH_DB_DIR_PATH && \
	sudo chown www-data:www-data /home/lizmap/QGIS_AUTH_DB_DIR_PATH         
         
USER root  
COPY files/xvfb /etc/init.d/xvfb
COPY files/fcgid.conf /etc/apache2/mods-enabled/fcgid.conf
COPY files/qgis-server.conf /etc/apache2/sites-available/qgis-server.conf
COPY files/start.sh /start.sh 
 
WORKDIR /var/www/ 
ADD https://github.com/3liz/$MYAPP/archive/$VERSION.zip /var/www/$VERSION.zip

RUN chmod +x /etc/init.d/xvfb && \
    update-rc.d xvfb defaults && \
    export LC_ALL="C" && a2enmod fcgid && a2enconf serve-cgi-bin && \
    a2dissite 000-default && \
    a2ensite qgis-server && \
    unzip /var/www/$VERSION.zip && \ 
    ln -s /var/www/$MYAPP-$VERSION/lizmap/www/ /var/www/html/lm && \
    rm /var/www/$VERSION.zip && \
    chmod +x /start.sh
    
WORKDIR /var/www/$MYAPP-$VERSION/
COPY files/*.php ./lizmap/var/config/

RUN php ./lizmap/install/installer.php && \   
    chown -R lizmap:users /var/www/$MYAPP-$VERSION && \
    chown -R www-data:www-data ./temp/ ./lizmap/var/ ./lizmap/www ./lizmap/install/qgis/edition/ && \
    chmod 775 -R ./temp/ ./lizmap/var/ ./lizmap/www ./lizmap/install/qgis/edition/
    
CMD /start.sh 
