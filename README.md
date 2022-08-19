# devopstest

This is an example of simple login service with admin/user role and CRUD functionality with a simple pipeline using Github Action. Action is triggered on push and PR merge which then builds and push the docker images in Dockerhub.

How to simulate:
1. Clone reposity and then run docker-compose and the service should run on http://localhost.
2. Create the database. You can access it via http://localhost/phpmyadmin and import the DB dump that you can find in the **db** folder of the repository.
3. Login as regular user or admin.
   Admin: fort@admin.com  |   admin123
   User:  test@user.com   |   test123
