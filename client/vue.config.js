const path = require('path');
const WebpackBar = require('webpackbar');

module.exports = {
  devServer: {
    public: '127.0.0.1',
    port: 3000,
    disableHostCheck: true,
    progress: false,
    watchOptions: {
      ignored: [/node_modules/],
      aggregateTimeout: 300,
      poll: 1000
    }
  },
  lintOnSave: process.env.NODE_ENV === 'production' ? 'default' : true,
  css: {
    loaderOptions: {
      sass: {
        additionalData: `@import "./src/sass/app";`
      }
    }
  },
  configureWebpack: () => {
    return {
      resolve: {
        alias: {
          '/@': path.resolve(__dirname, './src')
        }
      },
      plugins: [
        new WebpackBar({
          name: 'Client',
          reporters: ['fancy', 'profile'],
          profile: true
        })
      ]
    };
  }
};
