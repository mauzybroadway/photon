from collections import defaultdict
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from selenium.webdriver.support.ui import WebDriverWait
import sys
import os.path
import time
import string
import re

#print "=========================================================================="
#print "Please ensure that your image file is in the same directory as this script"
#print "=========================================================================="

#print "Enter the name of the image file: "
#filename = raw_input()

open("exitthevoid.pho", 'w').close()

def printlog(text):
        log = open('log.pho','a')
        log.write("%d: %s\n" % (time.time(),text))
        log.close()

def printout(text):
        outf = open('exitthevoid.pho','a')
        outf.write("%s\n" % text)
        outf.close()

if not os.path.isfile("enterthevoid.pho"):
        printlog("THE VOID DOES NOT ACCEPT YOU!");
        sys.exit()

with open("enterthevoid.pho") as pho:
        pics = [x.strip('\n') for x in pho.readlines()]



#  Assigning the user agent string for PhantomJS
dcap = dict(webdriver.DesiredCapabilities.PHANTOMJS)
dcap["phantomjs.page.settings.userAgent"] = ("Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:29.0) Gecko/20100101 Firefox/29.0")

def switcheroo(x,y):
        return y-x

def removearticles(text):
  return re.sub('(\s+)(a|an|and|the|or|of|in|to|if|out|for|had|has|is|was|where|when|how|who|why)(\s+)', '\1\3', text)

#  Function to search file from local machine
def searchfile():
        
        #  Decomment below to enable browser
        #browser = webdriver.Firefox()
        browser = webdriver.PhantomJS(desired_capabilities=dcap)

        browser.implicitly_wait(10)


        print "Connecting..."
        browser.get('http://www.google.com/imghp')

        for pic in pics:        
                if not os.path.isfile(pic):
                        printlog("Hey man, %s ain't from around here." % pic)
                        continue
                # Click "Search by image" icon
                elem = browser.find_element_by_class_name('gsst_a')
                elem.click()
                browser.implicitly_wait(10)
                
                # Switch from "Paste image URL" to "Upload an image"
                browser.execute_script("google.qb.ti(true);return false")
        

                # Set the path of the local file and submit
                print "Uploading %s" % pic
                elem = browser.find_element_by_id("qbfile")
                #elem.send_keys(filePath)
                elem.send_keys(pic)
                #  Clicking 'Visually Similar Images'
                print "Finding similar images..."
                ele1 = browser.find_element_by_link_text("Visually similar images")
                ele1.click()
                
                #  Selecting Image
                #print "Match Found"

                d = defaultdict(int)
                table = string.maketrans("","")
                
                print ("Match:"),
                for i in range(10):
                        print ("%d" % i),
                        ele2 = browser.find_element_by_xpath("//div[@data-ri='%d']/a" % i)
                        ele2.click()
                        
                        browser.implicitly_wait(10)
                        # Getting image description
                        desc = browser.find_elements_by_class_name('irc_su')
                        for elm in desc:
                                line = elm.text
                                lasc = line.encode('ascii','ignore')
                                ign = removearticles(lasc)
                                nopunc = ign.translate(table,string.punctuation)
                                #nopunc = line.translate({ord(k): None for k in string.punctuation})
                                for word in nopunc.lower().split():
                                        d[word] += 1
                                        
                s_d = sorted(d,key=d.__getitem__,cmp=switcheroo)
                strang = ",".join(s_d[:5])
                printout("%s:%s" % (pic,strang))
                print
                
                #  Clicking 'View image' to go to page
                #ele3 = browser.find_element_by_link_text("View image")
                #ele3.click()
                
        time.sleep(1)
                #print browser.current_url
                
                #  Getting URL of image and writing it to imageurl.txt
                #print "Saving URL of match to: imageurl.txt"
                #writeurl = open('imageurl.txt', 'w')
                #writeurl.write(browser.current_url)
                #writeurl.write("\n")
                #writeurl.close()
                #print "\n"
        browser.quit()
        
#  Function which takes last URL written to imageurl.txt and plugs it back into Google Image search
def searchurl():
        
        #  Decomment below to open browser
        #browser = webdriver.Firefox()
        
        print "Connecting to Google Image Search"
        #Comment below (1 line only) to disable headless when running Firefox
        browser = webdriver.PhantomJS(desired_capabilities=dcap)
        browser.implicitly_wait(60)
        browser.get('http://www.google.com.au/imghp')
        
        # Click "Search by image" icon
        elem = browser.find_element_by_class_name('gsst_a')
        elem.click()
        
        #  Sending the image URL from the last line
        #  Reading the last line of imageurl.txt
        print "Checking for the last URL from: imageurl.txt"
        fileHandle = open ( 'imageurl.txt',"r" )
        lineList = fileHandle.readlines()
        lasturl = lineList[len(lineList)-1]
        fileHandle.close()
        #print lineList
        print "The URL is:"
        print lasturl
        #print lineList[len(lineList)-1]
        
        print "Pasting URL into 'Search by image'"
        elem = browser.find_element_by_id("qbui")
        elem.send_keys(lasturl)
        
        #  Clicking 'Visually Similar Images'
        print "Searching for most similar match"
        ele1 = browser.find_element_by_link_text("Visually similar images")
        ele1.click()
        
        #  Selecting Image
        print "Match Found"
        ele2 = browser.find_element_by_xpath("//div[@data-ri='0']/a")
        ele2.click()
        
        #  Clicking 'View image' to go to page
        ele3 = browser.find_element_by_link_text("View image")
        ele3.click()
        
        
        #  Sleeping in order to get correct URL and not google redirect link
        print "snoozing.... zzzzzzz..... "
        time.sleep(1)
        
        #  Appending imageurl.txt with new url
        print "Writing new URL to imageurl.txt"
        writeurl = open('imageurl.txt', 'a')
        writeurl.write(browser.current_url)
        writeurl.write("\n")
        writeurl.close()
        print "\n"
        browser.quit()
        
#  Calls the first function
searchfile()

#  Calls the second function and runs 199 times.
#for i in range(0,199):
#        searchurl()
        
