# Microservices in PHP

You can setup the whole environment by running `docker-composer`. In this
distribution we're using docker volumes, so tearing down the environment and
running it again would work as expected.

```bash
docker-compose up --build
```

Once the environment is up and running, you can setup the infrastructure by
using some prebuilt scripts under docker scope. This will create an empty
MySQL database and a ready to use Rabbitmq queue for commands.

```bash
docker exec -it server sh /setup-environment.sh
```

You can clean all the infrastructure by using the script. This will delete the
MySQL database and the RabbiMQ queue.

```bash
docker exec -it server sh /clean-environment.sh
```

## Endpoints

You can use some endpoints exposed under the port `8000`. For example, you can
put a user resource.

```bash
curl -XPUT "http://localhost:8000/users/1" -d'{"name":"Marc", "age":34}'
```

You can get the resource using the same resource path

```bash
curl "http://localhost:8000/users/1" 
```

And you can delete it

```bash
curl -XDELETE "http://localhost:8000/users/1" 
```

## Tests

You can run tests with phpunit

```bash
docker exec -it server sh /run-tests.sh
```