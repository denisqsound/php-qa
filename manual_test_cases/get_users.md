# Проверка получения списка юзеров

## [TEST-4] Получение списка юзеров

### Test steps:

1. Запросим список юзеров

``` bash
curl 'http://3.145.97.83:3333/user/get'
```

### Ожидаемый результат

- Получаем список созданных юзеров
    - Ответ сервера 200 Ok
    - Ответ сервера в формате JSON. В ответе присутствуют все необходимые поля.
    - Тело ответа:

``` bash
[
    {
        "id": 1,
        "username": "value1",
        "email": "dadiv@wisebits.com",
        "password": "$2a$10$tSBp.NwFQemCnc3HoEpWReydnP1tdoq9fISag944uLAK8aYod4exO",
        "created_at": "2021-12-07 13:48:22",
        "updated_at": "2021-12-07 13:48:22"
    },
    {
        "id": 2,
        "username": "kkkskssa4294967294",
        "email": "dsa1d4294967294wa@test.com",
        "password": "$2a$10$p8LVhw6ecRT2KuEIWhvAHeQbRZzDxyfQW1el4h1NNEMcJpx1jE7Li",
        "created_at": "2021-12-07 14:21:57" ........
]

```

## [TEST-5] Получение информации о созданном пользователе

### Test steps:

1. Создадим юзера со всеми заполненными полями

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'username="Neha"' \
--form 'email="Trever_Hammes57@yahoo.com"' \
--form 'password="DHY9SiExVuFkxJq"'
```

2. Запросим список юзеров

``` bash
curl 'http://3.145.97.83:3333/user/get'
```

Ожидаемый результат:

- Ответ сервера 200 Ok
- В теле ответа должен содержаться созданный юзер. Необходимо чтобы совпадали поля
    - "username"
    - "email"
- В теле ответа должен быть уникальный (созданный в первом шаге) id юзера

## [TEST-8]  Проверка получения списка юзеров по http/https протоколу

### Test steps:

1. Запросим список юзеров по http

``` bash
curl 'http://3.145.97.83:3333/user/get'
```

### Ожидаемый результат

- Получаем список созданных юзеров
- Ответ сервера 200 Ok

### Test steps:

1. Запросим список юзеров по https

``` bash
curl 'https://3.145.97.83:3333/user/get'
```

### Ожидаемый результат

- Получаем список созданных юзеров
- Ответ сервера 200 Ok