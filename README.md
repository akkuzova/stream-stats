<p><a href="https://blooming-forest-01090.herokuapp.com/home">Open stream-stats</a>

## Stream stats test assignment

### Stack
Deployed and built with Heroku

PHP 8.1, Laravel Framework 8, MySql 8 (5.6.50-log on heroku deployment)

## Description and code placement

All statistics are retrieving from [DashboardController](https://github.com/akkuzova/stream-stats/blob/main/app/Http/Controllers/DashboardController.php)
using [UserStatsService](https://github.com/akkuzova/stream-stats/blob/main/app/Services/UserStatsService.php) and [Stream Model](https://github.com/akkuzova/stream-stats/blob/main/app/Models/Stream.php)

Once you are logged in with Twitch (used Socialite in [AuthController](https://github.com/akkuzova/stream-stats/blob/main/app/Http/Controllers/AuthController.php)) you can see following information to the user:

- calculated through database queries
  - [Total number of streams for each game](https://blooming-forest-01090.herokuapp.com/dashboard/streams_by_game). 
  - [Top games by viewer count for each game](https://blooming-forest-01090.herokuapp.com/dashboard/games_by_viewer).
  - [List of top 100 streams by viewer count that can be sorted asc & desc](http://blooming-forest-01090.herokuapp.com/dashboard/top_streams_by_viewer).
  - [Median](http://blooming-forest-01090.herokuapp.com/home) number of viewers for all streams
- calculated on the app layer
  - [Total number of streams by their start time (rounded to the nearest hour)](http://blooming-forest-01090.herokuapp.com/dashboard/top_streams_by_start_time).
  - The rest of statistics are on the home page [here](http://blooming-forest-01090.herokuapp.com/home)
    - Which of the top 1000 streams is the logged-in user following
    - How many viewers does the lowest viewer count stream that the logged-in user is following need to gain in order to make it into the top 1000
    - Which tags are shared between the user followed streams and the top 1000 streams

## Other

- session expire after a 1 hour
  - used a SESSION_LIFETIME const for it [here](https://github.com/akkuzova/stream-stats/blob/main/config/session.php#L34)
- setup a cronjob that refreshed the stream's data every 15 minutes.
  - Cron To Go Scheduler on Heroku was used to set up a Laravel Task Scheduling to run every minute
- used just a simple css in main.blade.php and blade templating for UX
