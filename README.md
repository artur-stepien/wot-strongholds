# World of Tanks - Strongholds 1.01 beta
This is just a simple application made to track users income from World of Tanks strongholds skirmishes. For now only in Polish language but translations will be released in next version.

##What it does:
- show last battle time
- show join date
- show user name and link to his profile
- show last two settlement periods ballance
- show last last settlement period income
- let user add new account ballance
- user can sort table by clicking on column header
- application is fully responsive (you can use it on mobile phones and tablets)

##Requirements:
- PHP 5
- [allow_url_fopen](http://php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen) setting ON
- [file_get_contents()](http://php.net/manual/en/function.file-get-contents.php) function allowed


##Installation parameters:
- clan tag name (for example `DPA_E` or `KAZNA`)
- [application id](https://eu.wargaming.net/developers/applications/)
- minimal resources income
- maximum absence time in days

##How does it work
I tried to make application as easy and user friendly as I could. So basicly what you have to do after installation is to add account ballance at every end of period. Of example first day of the month. For the application to work you have to include at least 2 ballance periods (untill Wargaming will finally decide to add API methods to get users resources income). Player is marked red if he does not play for certain number of days (by default 14). He is also marked as red if he does not earn minimum number of resources at end of perioud. Clanmates that are less then 30 days in clan are excluded from calculations (they does not turn red if they will not make minimum income).

##To-Do:
- authentication via Wargaming api or http
- test if server meets requirements
- add period time setting in installation (minimum number of days required to calculate user income)
- localization
