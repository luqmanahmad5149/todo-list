# todo-list
Track tasks completion API

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instruction for running and building the app
1. Open Source Tree.
2. Clone from URL:
    1. Source URL: https://github.com/luqmanahmad5149/todo-list.git
    2. Destination Path: /Users/Shared/todo-list
    3. Name: todo-list
    4. Checkout branch: main
3. Open terminal.
4. Go to the project directory by using this command “cd Users/Shared/todo-list”.
5. Type “make setup”. This command will build a docker image and execute the necessary script.
6. Create a .env file inside the project root.
7. Copy and paste the .env.example file content into the .env file.
8. Type “make data”. This command will run the Laravel migration and seeder.
9. Now you can open this URL “http://localhost:9000/“ and the home page will be shown.
10. Go to “http://localhost:9000/login” to be redirected to the login page.
11. For unit test execution, please enter the docker container first using this command “docker exec -it todo-list bash”. Then use this script “php artisan test” to execute the unit test.

## Instruction for Testing the app
1. First go to “http://localhost:9000/login” and login via Google.
2. After redirecting to “http://localhost:9000/dashboard”.
3. Download this postman collection for To-Do Api “https://drive.google.com/file/d/1bKjA6xffcFZl0m1IXQv_LZoIB2QVpvL5/view?usp=sharing”.
4. Import the collection inside Postman.
5. Go to the ToDo List -> Login. Then, enter the JSON body as follows.
    1. Email: "paraguayfromghell@gmail.com" -> Should be based on your google email.
    2. Password: “password” -> Don’t change, this is the default password.
6. You will get a token. Copy it and paste it inside the Authorization tab -> Bearer Token -> Token.
7. Now you can test all APIs using the API collection provided.

## API Interface Documentation
| HTTP Request | Endpoint        | Description                                   |
| :---:        | :---:           | :---:                                         |
| POST         | /login          | Login into the project and get authenticated. |
| POST         |  /task          |  Add a new task for the user.                 |
| GET          |  /tasks         |  Get all tasks created by the user.           |
| UPDATE       |  /task/update   |  Update task, selected by the user.           |
| DELETE       |  /task/delete   |  Delete task, selected by the user.           |

