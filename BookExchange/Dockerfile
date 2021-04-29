FROM continuumio/miniconda3

# Set environment variables
ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1

# Set work directory
ADD . /BookExchangeRec
WORKDIR /BookExchangeRec
#RUN conda install -c conda-forge crontab vim
# Install dependencies
COPY crontab /etc/cron.d/crontab
RUN apt-get -y install cron
#RUN apt-get install -y cron sudo
RUN chmod 0644 /etc/cron.d/crontab
RUN /usr/bin/crontab /etc/cron.d/crontab
#RUN conda install -c conda-forge --file requirements.txt
RUN pip3 install --no-cache-dir --disable-pip-version-check pandas scikit-learn
RUN pip3 install --no-cache-dir --disable-pip-version-check PyMySQL
RUN pip3 install -r requirements.txt

# Copy project
CMD ["cron", "-f"]