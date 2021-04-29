#!/usr/bin/python
# Import Pandas
import pandas as pd
import rake_nltk
import yaml

with open("/BookExchangeRec/config.yml", 'r') as ymlfile:
    cfg = yaml.load(ymlfile, Loader=yaml.FullLoader)
# with open("Config/config.yml", 'r') as ymlfile:
#     cfg = yaml.load(ymlfile)


# Function that takes in movie title as input and outputs most similar movies
def get_recommendations(md):
    # Get the index of the movie that matches the title
    # Get Metadata of all active opportunites for a client
    metadata = md

    #print(volunteerId)

    metadata = getMetadataSoup(metadata)
    # print(metadata)
    indices = getIndices(metadata)
    # print(indices)
    cosine_sim = getCosineSim(metadata)

    metadata['recommendations'] = ''

    for i in metadata.index:
        recommended_movies = []
        score_series = pd.Series(cosine_sim[indices[i]]).sort_values(ascending=False)
        # getting the indexes of the 10 most similar movies
        top_10_indexes = list(score_series.iloc[1:11].index)
        metadata.at[i, 'recommendations'] = top_10_indexes
    # Return the top 10 most similar movies
    return metadata


def getMetadataSoup(metadata):
    m = metadata
    m['genre'] = metadata['genre'].map(lambda x: x.lower().split(' '))
    m['type_name'] = metadata['type_name'].map(lambda x: x.lower().split(' '))
    m['title'] = metadata['title'].map(lambda x: x.lower().split(' '))
    m['author'] = metadata['author'].map(lambda x: x.lower().split(' '))

    m['description_keywords'] = ""

    for i in m.index:
        description = m.at[i, 'description']
        r = rake_nltk.Rake()
        r.extract_keywords_from_text(description)
        keywords_dict_score = r.get_word_degrees()
        m.at[i, 'description_keywords'] = list(keywords_dict_score.keys())

    m.drop(columns=['description'], inplace=True)
    m.set_index('item_id', inplace=True)
    m['soup'] = ''
    columns = m.columns
    for index, rows in m.iterrows():
        words = ''
        for col in columns:
            words = words + ' '.join(rows[col]) + ' '
        rows['soup'] = words

    m.drop(columns=[col for col in m.columns if col != 'soup'], inplace=True)

    return metadata


def getIndices(metadata):
    metadata = metadata.reset_index()
    indices = pd.Series(metadata.index, index=metadata['item_id'])
    return indices


def getCosineSim(metadata):
    # Import CountVectorizer and create the count matrix
    from sklearn.feature_extraction.text import CountVectorizer

    count = CountVectorizer(stop_words='english')
    count_matrix = count.fit_transform(metadata['soup'])

    # Compute the Cosine Similarity matrix based on the count_matrix
    from sklearn.metrics.pairwise import cosine_similarity

    cosine_sim2 = cosine_similarity(count_matrix, count_matrix)

    return cosine_sim2
    # Reset index of your main DataFrame and construct reverse mapping as before


