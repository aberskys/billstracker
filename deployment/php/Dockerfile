FROM datadoglt/php70
MAINTAINER "DataDog" <info@datadog.lt>

RUN yum install -y http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-centos7-amd64.rpm

RUN yum install -y \
    curl \
    cabextract \
    xorg-x11-font-utils \
    fontconfig \
    && yum clean all

RUN rpm -i https://downloads.sourceforge.net/project/mscorefonts2/rpms/msttcore-fonts-installer-2.6-1.noarch.rpm \
    && fc-cache -f -r -v
