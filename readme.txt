# Format of conf.ini
[DATABASE]
host = ip_number
dbname = name_of_database
user = username
passwd = password
port = number_of_port

;Tables of databas
[TABLENAME]
title = "table name in webapp"
table = "object name in project"
columns[field] = "alias"
tableDB = "table name in database"
orderbyDB = "field to sort the result-set in ascending or descending order"

# About
[folders]
helpers - helper functions that facilitate repetitive work
helpers/charmers - a subtype of a helper functions that facilitate work with python scripts
helpers/charmers/snakes - only python scripts (.py)
models -
views -
controllers -
[files]
controller.php -
SnakeCharmer.php - file to open and execute python script.
index.php - is startup file for example: for website.
conf.ini - file containing data of login to database.
test.py - sample python file.
ConnectorPG.py - is a class to connection with PostgreSQL database and execute query
readme.txt - file of instructions and important information.
.gitignore - the file used to ignore files when committing with GIT version control system, is important when we don't want to add data of login to the database connection.