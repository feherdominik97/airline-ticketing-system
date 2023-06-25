import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import {createApp} from 'vue'

import App from './App.vue'
import router from './router'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'

createApp(App).use(router).use(bootstrap).mount("#app")
