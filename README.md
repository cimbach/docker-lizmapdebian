# docker-lizmapdebian
## QGIS Server with Lizmap Web Client running on Debian Server

    Debian 10 (buster-slim)
    QGIS Server 2.18 (2.18.23 as of writing)
    Lizmap Web Client 3.1.12
    Projects from QGIS Desktop 2.18 (2.18.23) with Lizmap QGIS plugin 2.4 on Ubuntu 18.04

If you have a QGIS project along with its Lizmap config file, put them both in a subdirectory of */home/qgis_projetcs/* on your local computer.\
They will then be readily available in Docker for the Lizmap Web Client once the container has been started. You will still have to create a corresponding repository in the Lizmap administration page and set it as viewable.

Run `docker-compose up -d` as root from the cloned or downloaded directory (from the same location as the *docker-compose.yml* file).
This will build the Docker image and run the container.\
You can then access the Debian server with `docker exec -ti docker-lizmapdebian_docker-lizmapdebian_1 bash` as root.

If the container is stopped, you need to:
- remove it (`docker rm <container id>`) and 
- do a `docker-compose up -d` as above in order to restart it.\
or
- Run `docker run --mount type=bind,source=/home/qgis_projects,target=/home/qgis_projects -d -p 8888:80 docker-lizmapdebian:10-2.18-3.1.12 /bin/sh -c "/usr/bin/Xvfb  :99 -screen 0 1024x768x24 -ac +extension GLX +render -noreset & service apache2 restart; tail -f /dev/null"`

Lizmap Web Client administration page is located at http://localhost:8888/lm/admin.php

Ref:\
[QGIS Server installation](https://docs.qgis.org/testing/en/docs/training_manual/qgis_server/install.html)\
[X server for printing](https://www.itopen.it/qgis-server-setup-notes/)\
[Lizmap](https://docs.3liz.com/en/index.html)

Notes:\
The Dockerfile creates a user *lizmap* on Debian (password *lizmap*).\
QGIS Server is installed with user *lizmap*.\
Thanks **@jancelin** for his similar work which helped me understand how to do this!
