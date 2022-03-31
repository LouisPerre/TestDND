## Installation ##

## To start the project ##
Run the command :
`bin/console app:csvtotable products`
If you want the result to be in JSON : `bin/console app:csvtotable products -j`
<br/>

## CRON Execution ##
To execute this command every day you can add that line in `/etc/crontab/`
<br/>
`0 15 * * *    root     %Directory Of the Project% && php bin/console app:csvtotable products`