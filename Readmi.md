# Тестовое задание для PHP/Symfony разработчика
## Тимашенко 

### Требования чтобы запустить локально
- Doсker и docker-compose не ниже 20 версии (у меня Docker version 20.10.13, на 19 версии docker-compose не поддерживает исаользование env variables)
- GNU Make (чтобы удобно выполнять команды)

### Как развернуть проект
- сбилдить docker образы  - запустить в терминале ```make build```
- запустить контейнеры  - запустить в терминале ```make up```
- запустить миграции  - запустить в терминале ```make migrate```

### Примеры запросов
1. создание автора
```
curl --location --request POST 'http://127.0.0.1:8888/author/create' \
--header 'Content-Type: application/json' \
--data-raw '{
    "translations": [
        {"language" : "ru", "name" : "Александр Пушкин"},
        {"language" : "en", "name" : "Alex Pushkin"}
    ]
}'
```
2. создание книги
```
curl --location --request POST 'http://127.0.0.1:8888/book/create' \
--header 'Content-Type: application/json' \
--data-raw '{
    "translations": [
        {"language" : "ru", "title" : "Война и Мир"},
        {"language" : "en", "title" : "War and Peace"}
    ],
    "authors": [1]
}'
```

3. поиск книги по названию
```
curl --location --request GET 'http://127.0.0.1:8888/book/search?title=Война и Мир'
```
4. получить информацию о книге
```
curl --location --request GET 'http://127.0.0.1:8888/en/book/2'
```