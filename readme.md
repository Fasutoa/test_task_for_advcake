### 1. Клонирование и запуск
```bash
# Клонируйте репозиторий
git clone https://github.com/Fasutoa/test_task_for_advcake.git
cd test_task_for_advcake

# Запустите Docker-инфраструктуру
docker-compose up -d --build

# Для запуска тестов
docker-compose exec php ./vendor/bin/phpunit
