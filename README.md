# farms-demo
Readme.
Demo is made in 2 parts:
 
***Web version***: Inside the folder Web:  http://site.walkap.net/farms-demo/?lang=en&module=analytics

-  Technologies used:  Nodejs (bower component), chartist, and uses data from api(exercise-server.jar) hosted in a small server 
(It is a computer that I configured as server as demo). 
If you cannot see data, text or email me (My old computer might be closed).
-  Version control: Git
For building, I used my teenager’s package: php, html,css, JavaScript(Jquery).
-          Coding Patterns: mvc technologies (clear separation between code and design).
-          Code Source: Web/farms-demo
-          Platform : Visual Studio Code version : 1.63.2 (user setup), Laragon  Full 4.0.14, php 7.4.25

***Android Version***:  To be cloned and configured (localhost:8080 cannot be accessible via Android devices, read Challenges faced below)

-  Technologies: Java/Android (minSdkVersion 28, targetSdkVersion 31), Volley and Asynchronous tasks used to fetch data on  Api (exercise-server.jar).  ListView.  
Here only, the list of farms is displayed.  
-  Coding Patterns: MVP ( model View presenter)
-  Code source : Java/. 
-  Platform : Android Studio 4.0.1

*** Challenges faced***: find an easy way to demo the solution with tester no need to configure anything.
Android devices cannot fetch data on my localhost:8080 (In my log; 404 Error).

*** Solution*** : Android devices must be in the same wifi as the computer and the IP address obtained after typing: Ipconfig on cmd or powershell (Windows should be used). Also, this address must be allowed in our Manifest.
From the challenges faced, I decided to make the Api(exercise-server.jar) available online.

-          Approach 1: Deploy it(exercise-server.jar) on Microsoft Azure: using: Maven (mvn) tools, Azure Cli.
I deployed. well but the result was not as expected: https://farmwebapp1.azurewebsites.net/
-          Approach 2: Deploy on localhost and turn my old computer into a small server (accessible online) : The approach works well and it is what I am using for this demo.
Improvements are still to be done….
