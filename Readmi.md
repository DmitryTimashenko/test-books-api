- [ ] Создать фикстуры
- [ ] Написать тесты
- [ ] написать документацию

# Тестовое задание для PHP/Symfony разработчика
## Тимашенко Дмитрий

### Как развернуть проект

Заполнить базу тестовыми данными
```
docker-compose -f ./docker/docker-compose.yml exec -u www-data php-fpm bin/console doctrine:fixtures:load --env=test --no-interaction
```