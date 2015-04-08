from auth import anon_auth
from upload import upload_kitten
from pymongo import MongoClient
from fake_tagger import tag

imgur = anon_auth()
mongo = MongoClient()
db = mongo.photon

img_path = '../images/photo2.jpg'
image = upload_kitten(imgur, img_path, name="Ayyy", title="Ohhh", desc="oh word")

tags = tag(image['link'])
image['photon_tags'] = tags

db.images.insert(image)

