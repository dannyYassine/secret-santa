run-api:
	cd api ; php artisan serve
run-client:
	cd client ; yarn serve
run:
	php index.php
push-api-heroku:
	git subtree push --prefix api heroku master
push-client-firebase:
	firebase deploy
deploy-api:
	cd api;
	php artisan config:cache;
	cd ..;
	push-api-heroku;
deploy-client:
	cd client;
	yarn build;
	git add .;
	git commit -m "Deploy";
	git push;
	cd ..;
	firebase deploy;
