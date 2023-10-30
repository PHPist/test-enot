## Задача

Имеется система настроек пользователя
Задача: Реализовать систему подтверждения смены конкретной настройки пользователя по коду из смс / email / telegram с возможностью выбора пользователем другого метода

Какие вы выделили бы слои, абстракции, таблицы?

Реализуйте данную схему без интеграции конкретных сервисов / ORM / прочее на уровне интерфейсов / контроллеров

Нужна реализация на уровне интерфейсов / контроллеров
Конкретная реализация не нужна, если имеется ввиду прикрутить базу данных и/или какой-то сервис


## Реализация

`\routes\api.php`

GET /get-code - генерирует и отправляет код

POST /set-payment-method/{paymentMethod}  - Проверяет код и изменяет настройку






