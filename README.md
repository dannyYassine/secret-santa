# secret-santa

[![Build Status](https://travis-ci.com/dannyYassine/secret-santa.svg?branch=main)](https://travis-ci.com/github/dannyYassine/secret-santa)

### API set up on heroku

```
heroku buildpacks:set https://github.com/timanovsky/subdir-heroku-buildpack

heroku buildpacks:add heroku/php

heroku config:set PROJECT_PATH=api
```

Procfile and nginx_app.conf loccated in the api/ folder,
because heroku needs these files at the project root and so we had to use the buildpack above.


### Travis CI setup
