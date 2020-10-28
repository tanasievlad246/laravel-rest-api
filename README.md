<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Description
Small REST api built with laravel. Authentication with JWT.

## Routes

- /api/user-create (POST) used to register a new user
- /api/login (POST) used to log in by receiving a token with a life of 60 minutes
- /api/logout (POST) used to destroy the token received by the user previously
- /api/me (GET) responds with user data
- /api/todos (GET) responds with a list of all the user todos
- /api/todo/create (POST) creates a new todo
- /api/todo/{id} (GET) return the todo with the passed id
- /api/todo/{id}/update (PUT) updates the todo with the passed id
- /api/todo/{id}/delete (DELETE) deletes the todo with the passed id
 
