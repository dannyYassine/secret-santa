# secret-santa

### API set up on heroku

```
heroku buildpacks:set https://github.com/timanovsky/subdir-heroku-buildpack

heroku buildpacks:add heroku/php

heroku config:set PROJECT_PATH=api
```

### Travis CI setup