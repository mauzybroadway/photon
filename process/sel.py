#!/usr/bin/python
from selenium import webdriver
#unicode.encode('ascii','ignore')
browser = webdriver.PhantomJS()
browser.get("http://images.google.com/searchbyimage/upload")
html_source = browser.page_source
browser.find_element_by_id("qbfile").click()
#print(html_source)
#file = open("test.html","w")
#file.write(html_source)
#file.close()
