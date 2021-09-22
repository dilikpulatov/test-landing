# App Landing

###Step 1
Install [App Activity](https://github.com/dilikpulatov/test-activity)

###Step 2
Create file .env.local from example .env

###Step 3
~~~
docker run --rm --interactive --tty \
  --volume $(pwd):/app \
  composer update
~~~

###Step 4
~~~
docker-compose --env-file .env.local up --build
~~~