#!/usr/bin/env python3

'''
	Here's how you upload an image. For this example, put the cutest picture
	of a kitten you can find in this script's folder and name it 'Kitten.jpg'

	For more details about images and the API see here:
		https://api.imgur.com/endpoints/image
'''

# Pull authentication from the auth example (see auth.py)
from auth import anon_auth
from datetime import datetime

album = None # You can also enter an album ID here
img_path = '../images/photo1.jpg'

def upload_kitten(client, image_path, album=None, name=None, title=None, desc=None, anon=True):
	# Here's the metadata for the upload. All of these are optional, including
	# this config dict itself.

        
        config = {
		'album': album,
		'name':  name,
		'title': title,
		'description': desc
	}

        
	print("Uploading image...")
        image = client.upload_from_path(image_path, config=config, anon=anon)

	print("Done")

	return image


# If you want to run this as a standalone script
if __name__ == "__main__":
	client = anon_auth()
	image = upload_kitten(client, img_path, name="Not Porn", title="Not Porn", desc="for sure")

	print("Posted: %s" % (image['link']))
