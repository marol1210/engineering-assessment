# Introduction
Food can bring happiness to people. It will be great if we can have a app that is convenient and offer a variety of food options. Therefore, this project demo was conceived and born.

## System requirement
   `docker`   
   `php^8.1`  
   `composer^2.6`  
   `npm8.19`  
   `vue3 & vite`

# Feature
. It support cli command for query food carrier information & search food and so on.

. It has Web API service for SPA , Wechat miniapp.

# Future 
. ***Support for online WeChat payment and Taobao payment

. ***Diners are able to communicate online and have preliminary social attributes.

## Quick Start
1.The demo is a Laravel project. First , `cd` to project's dir and run :

```go
composer install
```

2.CLI commands

show Food truck vendor list
```
php artisan vendor:show
```
```
+-------------------------------------------------------------------------+
| Applicant     total: 122                                                |
+-------------------------------------------------------------------------+
| Alfaro Truck                                                            |
| Athena SF Gyro                                                          |
| Authentic India                                                         |
| BH & MT LLC                                                             |
| BOWL'D ACAI, LLC.                                                       |
| Bay Area Dots, LLC                                                      |
| Bay Area Mobile Catering, Inc. dba. Taqueria Angelica's                 |
| Bonito Poke                                                             |
| Boulangerie La Camionnette                                              |
| Brazuca Grill                                                           |
| Breakfast Embed                                                         |
| Buenafe                                                                 |
...
```

command option `--food_name`.  Search for suppliers of coffee food.
```
php artisan vendor:show --food_name=Coffee
```
```
+----------------------------+--------------+-----------------------------+-------------+-----------+---------------------------------------------------+
| Applicant     total: 22    | FacilityType | Address                     | permit      | Status    | FoodItems                                         |
+----------------------------+--------------+-----------------------------+-------------+-----------+---------------------------------------------------+
| Boulangerie La Camionnette |              | 500 FLORIDA ST              | 21MFF-00079 | REQUESTED | Bread: Pastries: Coffee: Pizza   	             | 
| Breakfast Embed            | Truck        | 234 01ST ST                 | 21MFF-00069 | REQUESTED | Coffee: Pastries: Bagels: Sandwiches: Other Items | 
| Breakfast Embed            | Truck        | 1200 04TH ST                | 21MFF-00069 | REQUESTED | Coffee: Pastries: Bagels: Sandwiches: Other Items |
+----------------------------+--------------+-----------------------------+-------------+-----------+---------------------------------------------------+

```

other command options.
```
php artisan help vendor:show
```
```
Description:
  show & fliter vendor

Usage:
  vendor:show [options]

Options:
      --path_csv_file[=PATH_CSV_FILE]  path to csv file [default: "./Mobile_Food_Facility_Permit.csv"]
      --head_fields[=HEAD_FIELDS]      The field of table head that name is case insensitive. `*` represents all [default: "Applicant"]
      --applicant[=APPLICANT]          The applicant of vendor
      --facility_type[=FACILITY_TYPE]  Facility type
      --status[=STATUS]                The Vendor status
      --food_name[=FOOD_NAME]          the food which vendor supply
```


# Web site
start web server to visit web site
```
docker composer up -d
```

visit url
```
http://localhost:8880
```





# Engineering Challenge

We strive to be a practical and pragmatic team. That extends to the way that we work with you to understand if this team is a great fit for you. We want you to come away with a great understanding of the kind of things that we actually do day to day and what it is like to work in our teams.

We don't believe that whiteboard coding with someone watching over your shoulder accurately reflects our day to day. Instead we'd like to be able to discuss code that you have already written when we meet.

This can be a project of your own or a substantial pull request on an open source project, but we recognize that most people have done private or proprietary work and this engineering challenge is for you.

We realize that taking on this assignment represents a time commitment for you, and we do not take that lightly. Throughout the recruitment process we will be respectful of your time and commit to working quickly and efficiently. This will be the only technical assessment you'll be asked to do. The brief following conversations will be based on this assessment and your prior experiences.

## Challenge Guidelines

* This is meant to be an assignment that you spend approximately two to three hours of focused coding. Do not feel that you need to spend extra time to make a good impression. Smaller amounts of high quality code will let us have a much better conversation than large amounts of low quality code.

* Think of this like an open source project. Create a repo on Github, use git for source control, and use a Readme file to document what you built for the newcomer to your project.

* We build systems engineered to run in production. Given this, please organize, design, test, deploy, and document your solution as if you were going to put it into production. We completely understand this might mean you can't do much in the time budget. Prioritize production-readiness over features.

* Think out loud in your documentation. Write our tradeoffs, the thoughts behind your choices, or things you would do or do differently if you were able to spend more time on the project or do it a second time.

* We have a variety of languages and frameworks that we use, but we don't expect you to know them ahead of time. For this assignment you can make whatever choices that let you express the best solution to the problem given your knowledge and favorite tools without any restriction. Please make sure to document how to get started with your solution in terms of setup so that we'd be able to run it.

* Once this is functioning and documented to your liking, either send us a link to your public repo or compress the project directory, give the file a pithy name which includes your own name, and send the file to us.

## The Challenge

As the song says, "you've got to play the hand you're dealt", and in this case your hand is to implement something to help us manage our food truck habit.

Our team loves to eat. They are also a team that loves variety, so they also like to discover new places to eat.

In fact, we have a particular affection for food trucks. One of the great things about Food Trucks in San Francisco is that the city releases a list of them as open data.

Your assignment is to make it possible for our teams to do something interesting with this food trucks data.

This is a freeform assignment. You can write a web API that returns a set of food trucks. You can write a web frontend that visualizes the nearby food trucks for a given place. You can create a CLI that lets us get the names of all the taco trucks in the city. You can create system that spits out a container with a placeholder webpage featuring the name of each food truck to help their marketing efforts. You're not limited by these ideas at all, but hopefully those are enough help spark your own creativity.
San Francisco's food truck open dataset is [located here](https://data.sfgov.org/Economy-and-Community/Mobile-Food-Facility-Permit/rqzj-sfat/data) and there is an endpoint with a [CSV dump of the latest data here](https://data.sfgov.org/api/views/rqzj-sfat/rows.csv). We've also included a copy of the data in this repo as well.
