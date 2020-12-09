#!/bin/sh

setup_git() {
  git remote add heroku "https://${ENV_HEROKU_USERNAME}:${ENV_HEROKU_PASSWORD}@git.heroku.com/dannyyassine-secret-santa.git"
  git config --global user.email "travis@travis-ci.org"
  git config --global user.name "Travis CI"
}

deploy() {
  git subtree push --prefix api heroku master
}

setup_git
deploy
