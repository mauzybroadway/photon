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
image_path = '../images/photo1.jpg'

def upload_kitten(client):
	# Here's the metadata for the upload. All of these are optional, including
	# this config dict itself.
	config = {
		'album': album,
		'name':  'Not Porn',
		'title': 'Definitely not porn',
		'description': 'There\'s only a slight chance that this is porn.'
	}

	print("Uploading image... ")
	image = client.upload_from_path(image_path, config=config, anon=True)
	print("Done")
	print()

	return image


# If you want to run this as a standalone script
if __name__ == "__main__":
	client = authenticate()
	image = upload_kitten(client)

	print("Posted at: {0}".format(image['link']))
