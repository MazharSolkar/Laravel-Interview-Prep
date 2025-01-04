user table
- id, name, email, password.
- has many posts

post table
- id, title, content.
- belong to user

UserController
- login, logout, register, reset password.

PostController
- add, update, delete
- authorization with gate and policy.
