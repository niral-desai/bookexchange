#!/usr/bin/python
import logging
from Db import connect
import pandas as pd
import yaml

import Book as book

with open("/BookExchangeRec/config.yml", 'r') as ymlfile:
    cfg = yaml.load(ymlfile, Loader=yaml.FullLoader)
# with open("Config/config.yml", 'r') as ymlfile:
#     cfg = yaml.load(ymlfile)

import datetime
# from Email import get_recommendations
metadataDict = {}
logging.basicConfig(filename='GatherBookHistory.log', format='%(levelname)s:%(asctime)s:%(message)s', datefmt='%m/%d/%Y %I:%M:%S %p', level=logging.DEBUG)


def getOriginalMetadata():
    print("Original MetaData COllected")
    # Load Movies Metadata
    # metadata = pd.read_csv('Opp.csv', low_memory=False)
    con = connect()
    x = 'select * from book_view;'
    metadata = pd.read_sql(x, con)
    #   print metadata['projectName'].head()
    # Print plot overviews of the first 5 movies.
    # print metadata['projectName'].head()
    con.close()
    return metadata


def getBookHistory():

    try:
        conn = connect()
        cursor = conn.cursor()

        # Read a single record
        sql = "select user_id, GROUP_CONCAT(item_id) as items from wishlist group by user_id ;"
        cursor.execute(sql)
        result = cursor.fetchall()
        conn.close()
        return result
    except Exception as e:
        logging.info("Error in getBookHistory Function")
        logging.error(repr(e))


def parallelCall(m):
    print("Parallel call started")
    if cfg['debug']['FLAG']:
        logging.info("Recommendation started")

    # m = getOriginalMetadata(clientId)
    try:
        recommendations = book.get_recommendations(m)
    except Exception as e:
        error = e
        logging.error("Error in getting Recommendations"+repr(e))
        return
    # recommendationsList = ', '.join(str(x) for x in recommendations.tolist())
    # print(recommendationsList)
    for i in recommendations.index:
        try:
            item_id = i
            recommendations_list = m.at[i, 'recommendations']
            conn = connect()
            cursor = conn.cursor()
            sql = "INSERT INTO recommendations (item_id, recommendation) values (%s, %s) on DUPLICATE KEY UPDATE recommendation = %s"
            cursor.execute(sql, (item_id, str(",".join(str(i) for i in recommendations_list)), str(",".join(str(i) for i in recommendations_list))))
            conn.commit()
            conn.close()
        except Exception as e:
            logging.error("Error while writing recommendation to the table")
            logging.error(item_id + ":" + repr(e))

    if cfg['debug']['FLAG']:
        logging.info("Recommendation Ended")

    print("Paralled call ended")


def main():
    print("Main Started")
    metadata = getOriginalMetadata()
    result = parallelCall(metadata)


if __name__ == '__main__':
    print("I was here to start main")
    main()
