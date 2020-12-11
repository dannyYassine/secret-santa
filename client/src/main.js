import Vue from 'vue'
import Buefy from 'buefy';
import 'buefy/dist/buefy.css'

import App from './App.vue'
import '/@/sass/all.scss';

Vue.config.productionTip = false

Vue.use(Buefy, {
  defaultIconPack: 'fa'
});

new Vue({
  render: h => h(App),
}).$mount('#app')
