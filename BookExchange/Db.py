#!/usr/bin/python
import yaml
import pymysql

with open("/BookExchangeRec/config.yml", 'r') as ymlfile:
    cfg = yaml.load(ymlfile, Loader=yaml.FullLoader)

def connect():
    connection = pymysql.connect(host=cfg['mysql']['HOST'],
                                 user=cfg['mysql']['USER'],
                                 password=cfg['mysql']['PASSWORD'],
                                 database=cfg['mysql']['DATABASE'],
                                 cursorclass=pymysql.cursors.DictCursor,)
    return connection
