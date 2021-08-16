# Weather-API-Project

## Name: 
Suong D. Tran

### Description:

This project will utilize two main APIs: [Google map](https://console.cloud.google.com/home/dashboard) and [Weather Stack](https://weatherstack.com/dashboard) as well as [PostMan](https://documenter.getpostman.com/view/1134062/T1LJjU52) to create a project so that user can choose a capital from the list and the Google Map will direct the user to said country. There will also be information about the weather at said country.

### What went wrong:
I tried to included a list of all the city instead of just the capital, but turned out there are more cities in the world than I have anticipated. This ended up slowing down the loading speed of the page significantly. Thus, I have changed it so that the GET request to PostMan only return the name of all the capital for now.
