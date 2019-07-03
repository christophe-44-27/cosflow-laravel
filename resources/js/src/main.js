import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import Vuesax from 'vuesax'

Vue.use(Vuesax)
axios.defaults.baseURL = 'http://cosflow-laravel.test'
axios.defaults.headers.get['Accepts'] = 'application/json'

import '../themeConfig.js'
import './globalComponents.js'
import router from './router'
import store from './store/store'
import './filters/filters'
import { VueHammer } from 'vue2-hammer'

Vue.use(VueHammer)

import 'prismjs'
// import 'prismjs/themes/prism-tomorrow.css'

Vue.config.productionTip = false

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
