This folder contains two copies for the file "httpd.conf" that located at the 
location "xampp\apache\conf\" on the xampp, one is the original before it's being 
altered one after being altered. 

I've taken this file as a backup from the events app server because I've altered 
some values in it to stop the log file from getting bigger in size because that 
made the server to stop from working because it was out of space.

The altered values:
a- Change "LogLevel warn" and "LogLevel info" entries to "LogLevel emerg".
b- Change "CustomLog logs/access.log common" and  "CustomLog logs/access.log combined" entries 
    to "#CustomLog logs/access.log combined".