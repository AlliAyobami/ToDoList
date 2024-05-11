## About This To Do

In line with the Task: Build a RESTful API for a To-Do List Application.

**USER AUTH ENDPOINTS**

Instructions:

1. Kindly use **api/v1/auth/register** to register an account
2. Kindly use **api/v1/auth/verify-user-email** to verify user
3. Kindly use **api/v1/auth/login** to login a user and generate a bearer token
4. Kindly use **api/v1/auth/logout** to log a user out.

''''''REGISTER''''''''''''''''''
"name": "Auth Register",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/register",
"method": "POST",
"bodyParams":
{
"name":"Ayobamiwale",
"email":"ayobamialli29@gmail.com",
"phone":"09087674356",
"password":"thisisgreat",
"password_confirmation":"thisisgreat"
},

''''''VERIFY EMAIL''''''''''''''''''
"name": "Auth VERIFY Email",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/verify-user-email",
"method": "POST",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"thisisgreat"
},

''''''LOGIN''''''''''''''''''
"name": "Auth Login",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/login",
"method": "POST",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"thisisgreat"
},

''''''LOGOUT''''''''''''''''''
"name": "Auth Logout",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/logout",
"method": "GET",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"theisgreat"
},

**TO DO ENDPOINTS**

Instructions:

1. Kindly use **api/v1/todo/create** to create a to do list
2. Kindly use **api/v1/auth/verify-user-email** to verify user
3. Kindly use **api/v1/auth/login** to login a user and generate a bearer token
4. Kindly use **api/v1/auth/logout** to log a user out.

''''''CREATE TODO''''''''''''''''''
"name": "toDo.store",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/create",
"method": "POST",
"bodyParams":
{
"name":"Cooking",
"due_date":"2023-12-28T11:33:09.20",
"status":"pending"
},
\*\*Bearer Auth required!

''''''GET USER TO DO LIST''''''''''''''''''
"name": "Auth VERIFY Email",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/user/list",
"method": "POST",
"bodyParams":
{
},
\*\*Bearer Auth required!

''''''LOGIN''''''''''''''''''
"name": "toDo.store",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/login",
"method": "POST",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"thisisgreat"
},

''''''LOGOUT''''''''''''''''''
"name": "Auth Logout",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/logout",
"method": "GET",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"theisgreat"
},
