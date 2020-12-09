#!/bin/sh

setup_git() {
  git config --global user.email "travis@travis-ci.org"
  git config --global user.name "Travis CI"
  git remote add heroku https://${ENV_HEROKU_USERNAME}:${ENV_HEROKU_PASSWORD}@git.heroku.com/dannyyassine-secret-santa.git > /dev/null 2>&1
}

deploy() {
  git subtree push --prefix api heroku master
}

setup_git
deploy
