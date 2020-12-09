#!/bin/sh

setup_git() {
  git config --global user.email "travis@travis-ci.org"
  git config --global user.name "Travis CI"
}

deploy() {
  git subtree push --prefix api https://${ENV_HEROKU_USERNAME}:${ENV_HEROKU_PASSWORD}@git.heroku.com/dannyyassine-secret-santa.git
}

setup_git
deploy
