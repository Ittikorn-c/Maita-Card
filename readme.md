

# Maita Card -  Card Holder  Web Application
## Introduction

## Get Started

 1. Clone project
		`git clone https://github.com/natthapach/Maita-Card.git   `
 2. Create database in your database system
 3. Copy ***.env.example*** and change name to ***.env***
 4. In ***.env*** file, setup your Database configuration
	 - DB_DATABASE=mydatabase_name
	 - DB_USERNAME=myusername
	 - DB_PASSWORD=mypassword
 5. In ***.env*** file, setup your Email configuration
	- MAIL_USERNAME=mymail@gmail.com
	- MAIL_PASSWORD=myapp_password
	**Note** for use gmail to sent email you must do followed instructions
		1. Goto security setting for your gmail (myaccount.google.com/security)
		2. In Apps with account access section, you will see ***Allow less secure apps***, turn on it.
		3. In Signing to Google section, enter to ***2-Step Verification***. Follow their step to activate this feature.
		4. Back to Signing to Google section. Now, You will see ***App passwords***. Enter and generate new *app password*
		5. use this *app password* for MAIL_PASSWORD
	**Note** some organize gmail such as *ku.th* not have ***2-Step Verification***
 6. Load dependencies to your project with
	```
	$ composer update
	$ npm install
	```
 7. Generate key for your project 
	 ```
	 $ php artisan key:generate
	 ```
 8. Migrate your database
	```
	$ php artisan migrate
	```
9. If your want to fake data in your database, we provide 2 seeder for seeding data
	- **DatabaseSeeder**	use for basic seeding data  
		```
		$ php artisan db:seed
		```
	- **BigDataSeeder** use for seeding a lot of data record (In summary, up to 30,000 record)
		```
		$ php artisan db:seed --class=BigDataSeeder
		```
		**Remember** It use a lot of time to seed with this seeder (may be a few hours)
10. Now, your project is ready. Let's start it.
	```
	$ php artisan serve
	```
