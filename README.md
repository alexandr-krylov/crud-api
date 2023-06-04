# CRUD api - test task
## What is it?
![task](./task.png)
## Getting, deploy, run
1. git clone 
1. cd crud-api
1. docker-compose up
1. docker exec -it crud-api composer install
1. docker exec -it crud-api composer db:create
## Using
Send requests with postman
## Testing
docker exec -it crud-api composer test
## Code lintering (code sniffing)
docker exec -it crud-api composer code-sniffer
