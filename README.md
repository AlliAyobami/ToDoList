## About This To Do

In line with the Task: Build a RESTful API for a To-Do List Application. \*_INSTALLATION_

1. Kindly clone this repo
2. You can use this in XAMMP, WAMP or DOCKER. (recommend Xammp), requires php 8.2, mysql
3. Run php artisan migrate
4. You can follow the spec below or make use of http://127.0.0.1:8000/docs

**USER AUTH ENDPOINTS**

Instructions:

1. Kindly use **api/v1/auth/register** to register an account
2. Kindly use **api/v1/auth/verify-user-email** to verify user
3. Kindly use **api/v1/auth/login** to login a user and generate a bearer token
4. Kindly use **api/v1/auth/logout** to log a user out.

''''''REGISTER''''''''''''''''''
"name": "users.register",
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
"name": "users.verifyUserEmail",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/verify-user-email",
"method": "POST",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"thisisgreat"
},

''''''LOGIN''''''''''''''''''
"name": "users.login",
"api endpoint": "http://127.0.0.1:8000/api/v1/auth/login",
"method": "POST",
"bodyParams":
{
"email":"ayobamialli29@gmail.com",
"password":"thisisgreat"
},

''''''LOGOUT''''''''''''''''''
"name": "users.logout",
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
2. Kindly use **api/v1/todo/user/list** to get all to do list created by a user
3. Kindly use **api/v1/todo/{id}** to get single to do list
4. Kindly use **api/v1/todo/update/{id}** to update single todo.
5. Kindly use **api/v1/todo/delete/{id}** to delete single todo.

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
Param{
name: string
due_date: datetime
status: enum(pending, ongoing, completed)
}

''''''GET USER TO DO LIST''''''''''''''''''
"name": "toDo.list",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/user/list",
"method": "GET",
\*\*Bearer Auth required!

''''''GET A TODO LIST''''''''''''''''''
"name": "toDo.show",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/{id}"",
"method": "GET",
\*\*Bearer Auth required!

''''''UPDATE A TODO LIST''''''''''''''''''
"name": "toDo.update",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/update/{id}",
"method": "PUT",
"bodyParams":
{
"name":"Singing",
"status":"ongoing"
},
\*\*Bearer Auth required!
Param{
name: string
due_date: datetime
status: enum(pending, ongoing, completed)
}

''''''DELETE A TODO LIST''''''''''''''''''
"name": "toDo.delete",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/delete/{id}",
"method": "DELETE",
\*\*Bearer Auth required!

**TASK ENDPOINTS**

Instructions:

1. Kindly use **api/v1/todo/{id}/task** to create a todo task
2. Kindly use **api/v1/todo/{id}/task** to get all todo tasks
3. Kindly use **api/v1/task/{id}** to get single to do task
4. Kindly use **task/{id}/update** get task interval.
5. Kindly use **api/v1/task/{id}/timeline** get task interval.
6. Kindly use **api/v1/task/{id}/delete** to delete single todo.

''''''CREATE TODO TASK''''''''''''''''''
"name": "task.store",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/{id}/task",
"method": "POST",
"bodyParams":
{
"description":"Cooking",
"due_date":"2023-12-28T11:33:09.20",
"status":"pending"
"priority":"high"
},
\*\*Bearer Auth required!
Param{
description: string
due_date: datetime
status: enum(pending, ongoing, completed)
priority: enum(critical, high, medium, low, planning)
}

''''''GET ALL TO DO TASKS''''''''''''''''''
"name": "task.lists",
"api endpoint": "http://127.0.0.1:8000/api/v1/todo/{id}/task",
"method": "GET",
\*\*Bearer Auth required!

''''''GET A TODO LIST''''''''''''''''''
"name": "task.show",
"api endpoint": "http://127.0.0.1:8000/api/v1/task/{id}"",
"method": "GET",
\*\*Bearer Auth required!

''''''UPDATE A TASK INTERVAL''''''''''''''''''
"name": "task.update",
"api endpoint": "http://127.0.0.1:8000/task/{}/update",
"method": "PUT",
"bodyParams":
{
"description":"Cooking",
"due_date":"2023-12-28T11:33:09.20",
"status":"pending"
"priority":"high"
},
\*\*Bearer Auth required!
Param{
description: string
due_date: datetime
status: enum(pending, ongoing, completed)
priority: enum(critical, high, medium, low, planning)
}

''''''TIMELINE A TASK INTERVAL''''''''''''''''''
"name": "task.interval",
"api endpoint": "http://127.0.0.1:8000/api/v1/task/{}/timeline",
"method": "GET",
\*\*Bearer Auth required!

''''''DELETE A TASK''''''''''''''''''
"name": "task.delete",
"api endpoint": "http://127.0.0.1:8000/api/v1/task/{}/delete",
"method": "DELETE",
\*\*Bearer Auth required!
