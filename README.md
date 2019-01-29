# docker-lizmapdebian
## QGIS Server with Lizmap Web Client running on Debian Server

    Debian 10 (buster-slim)
    QGIS Server 2.18 or 3.4
    Lizmap Web Client 3.2.1
    tag name: 10-2.18-3.2.1 or 10-3.4-3.2.1 

If you want QGIS 2.18, set `QGISREPO=https://qgis.org/debian-ltr` in the docker-compose.yml file.\
If you want QGIS 3.4, set `QGISREPO=https://qgis.org/debian` in the docker-compose.yml file.

If you have a QGIS project along with its Lizmap config file, put them both in a subdirectory of */home/qgis_projects/* on your local computer.\
They will then be readily available in Docker for the Lizmap Web Client once the container has been started. You will still have to create a corresponding repository in the Lizmap administration page and set it as viewable.

Do a `docker-compose up -d` as root from the cloned or downloaded directory (from the same location as the *docker-compose.yml* file).
This will build the Docker image and create the container.\
To start the container you need to launch 
`docker run --mount type=bind,source=/home/qgis_projects,target=/home/qgis_projects -d -p 8888:80 docker-lizmapdebian:<tag name> /bin/sh -c "/usr/bin/Xvfb  :99 -screen 0 1024x768x24 -ac +extension GLX +render -noreset & service apache2 restart; tail -f /dev/null"`

If you want to access the server,`docker exec -ti <container_id> bash` 

Lizmap Web Client administration page is located at http://localhost:8888/lm/admin.php (*admin* / *admin*)\
PHP info at http://localhost:8888/lm/phpinfo.php

Ref:\
[QGIS Server installation](https://docs.qgis.org/testing/en/docs/training_manual/qgis_server/install.html)\
[X server for printing](https://www.itopen.it/qgis-server-setup-notes/)\
[Lizmap](https://docs.3liz.com/en/index.html)

Notes:\
The Dockerfile creates a user *lizmap* on Debian (password *lizmap*).\
QGIS Server is installed with user *lizmap*.\
Thanks **@jancelin** for his similar work which helped me understand how to do this!
