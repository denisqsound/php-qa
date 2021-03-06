# Проверка создания юзера

## [TEST-1] Создание юзера с валидными данными

### Test steps:

1. Создадим юзера со всеми заполненными полями

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'username="Marques"' \
--form 'email="Kris_Huels@yahoo.com"' \
--form 'password="vUQ_1TUkyBfW9rL"'
```

Ожидаемый результат:

- Ответ сервера 200 Ok
- Ответ сервера в формате JSON. В ответе присутствуют все необходимые поля.
- Тело ответа:

``` bash
{
    "success": true,
    "details": {
        "username": "Marques",
        "email": "Leopoldo.Cummerata85@gmail.com",
        "password": "$2a$10$e.4q9uuQPj4Qv7oBb/OSW.iKlmetPEqSNtPKof8in.XjYIYHocvRa",
        "created_at": "2022-01-21 17:34:23",
        "updated_at": "2022-01-21 17:34:23",
        "id": 6
    },
    "message": "User Successully created"
}
```

## [TEST-2] Повторное создание юзера с валидными данными

### Test steps:

1. Выполним шаги из кейса TEST-1
2. Повторно создами юзера с такими же параметрами в полях username, email, password

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'username="Marques"' \
--form 'email="Kris_Huels@yahoo.com"' \
--form 'password="vUQ_1TUkyBfW9rL"'
```

### Ожидаемый результат:

- Ответ сервера 400 Bad Request
- Response Body :

``` bash
{"success":false,"message":["Email already exists"]}
```

## [TEST-3]  Незаполнение обязательных полей

### Test steps:

1. Создадим юзера с незаполненным полем username

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'email="Kris_Huels@yahoo.com"' \
--form 'password="vUQ_1TUkyBfW9rL"'
```

### Ожидаемый результат:

- Ответ сервера 400 Bad Request
- Response body :

``` bash
{"success":false,"message":["A username is required"]}
```

2. Создадим юзера с незаполненным полем email

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'username="Darby"' \
--form 'password="tRHLEIEboH9aRx5"'
```

Ожидаемый результат:

- Ответ сервера 400 Bad Request
- Response body :

``` bash
{"success":false,"message":["An Email is required"]}
```

3. Создадим юзера с незаполненным полем password

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'username="Brisa"' \
--form 'email="Autumn_Brown96@gmail.com"' 
```

Ожидаемый результат:

- Ответ сервера 400 Bad Request
- Response body :

``` bash
{"success":false,"message":["A password for the user"]}
```

4. Создадим юзера со всеми пустыми полями

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' 
```

Ожидаемый результат:

- Ответ сервера 400 Bad Request
- Response body :

``` bash
{"success":false,"message":["A username is required"]}
```

## [TEST-6]  Невалидные значения при создании юзера

### Test steps:

1. При создании пользователя в поле username указать

- Большое количество символов (255, 256, 257, 1000, 1024, 2000, 2048 количество символов)
- Буквы с диакритическими знаками (àáâãäåçèéêëìíîðñòôõöö,    )
- Общие разделители и специальные символы (“ ‘ ` | / \ , ; : & < > ^ * ? Tab Enter)
- SQLi (select * from users)
- Русское имя (Иван)
- Список имен [Marge , Linnie]

### Ожидаемый результат:

- Пользователь создастся

### Test steps:

1.1 При создании пользователя в поле username указать

- Пустая строка
- Один пробел / Много пробелов

### Ожидаемый результат:

- Пользователь не создастся (400 Bad Request)

``` bash 
{
    "success": false,
    "message": [
        "A username is required"
    ]
}
```

### Test steps:

2. При создании пользователя в поле email указать

- Почту без @ (qwe.qwe)
- Почту без . (qwe@qwe)

### Ожидаемый результат:

- Пользователь не создастся (400 Bad Request)

### Test steps:

2.1 При создании пользователя в поле email указать:

- Русские буквы (почта@мейл.рус)

### Ожидаемый результат:

- Пользователь создастся

### Test steps:

3. При создании пользователя в поле password указать

- Слишком короткий пароль (qwe123)
- Только цифры
- Только буквы
- Один пробел / Много пробелов
- Пустая строка ("")
- Буквы с диакритическими знаками (àáâãäåçèéêëìíîðñòôõöö,    )
- SQLi (select * from users)
- Общие разделители и специальные символы (“ ‘ ` | / \ , ; : & < > ^ * ? Tab Enter)
- Большое количество символов (255, 256, 257, 1000, 1024, 2000, 2048 количество символов)

### Ожидаемый результат

- Пользователь не создастся (400 Bad Request)

### Test steps:

4. Указать дополнительные поля

- id (существующий / отрицательный / 1E-16 / 0.0001 / 1,234,567 / 1.234.567,89 / 1000+1)
- created_at (2022-01-32 19:17:50 / 2021-02-29 19:17:50 / June 5, 2001 / 06/05/2001 / 06/05/01 / 06-05-01 / 6/5/2001 12:
  34)
- updated_at (2022-01-32 19:17:50 / 2021-02-29 19:17:50 / June 5, 2001 / 06/05/2001 / 06/05/01 / 06-05-01 / 6/5/2001 12:
  34)
- message ("User Successully created")
- success (true)

### Ожидаемый результат

- Пользователь не создастся (400 Bad Request)

## [TEST-7]  Проверка создания юзера по http/https протоколу

### Test steps:

1. Создадим юзера со всеми заполненными полями по http

``` bash
curl --location --request POST 'http://3.145.97.83:3333/user/create' \
--form 'username="Marques"' \
--form 'email="Kris_Huels@yahoo.com"' \
--form 'password="vUQ_1TUkyBfW9rL"'
```

### Ожидаемый результат

- Ответ сервера 200 Ok
- Response Body :

``` bash
{
    "success": true,
    "details": {
        "username": "Marques",
        "email": "Leopoldo.Cummerata85@gmail.com",
        "password": "$2a$10$e.4q9uuQPj4Qv7oBb/OSW.iKlmetPEqSNtPKof8in.XjYIYHocvRa",
        "created_at": "2022-01-21 17:34:23",
        "updated_at": "2022-01-21 17:34:23",
        "id": 6
    },
    "message": "User Successully created"
}
```

### Test steps:

2. Создадим юзера со всеми заполненными полями по https

``` bash
curl --location --request POST 'https://3.145.97.83:3333/user/create' \
--form 'username="Velda"' \
--form 'email="Kayli.Windler74@gmail.com"' \
--form 'password="foct3C1fnUgxw2O"'
```

### Ожидаемый результат

- Ответ сервера 200 Ok
- Response Body :

``` bash
{
    "success": true,
    "details": {
        "username": "Velda",
        "email": "Kayli.Windler74@gmail.com",
        "password": "$2a$10$TvXXzypBlGZtjsz.aoaA6Oe7qwlG24UMzIHDsP7wAe4GnkItuldky",
        "created_at": "2022-01-21 19:33:23",
        "updated_at": "2022-01-21 19:33:23",
        "id": 4294967303
    },
    "message": "User Successully created"
}
```
