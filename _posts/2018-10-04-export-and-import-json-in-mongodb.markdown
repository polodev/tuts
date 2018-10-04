---
title: export and import json in mongodb
layout: post
---

# exporting in mongo db 

~~~bash
mongoexport -d database_name -c collection_name -o file_name

~~~

# importing in mongodb 

~~~bash
mongoimport -d datbase_name -c collection_name file_name
~~~