git pull
docker-compose exec web_php php yii migrate --interactive=0
docker-compose exec web_php php yii cache/flush-all
docker-compose exec web_php composer install
