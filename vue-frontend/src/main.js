
import { createApp } from 'vue'
import App from './App.vue'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'vue-toastification/dist/index.css'

import router from './router'
import { createPinia } from 'pinia'
import Toast from 'vue-toastification'

createApp(App)
    .use(router)
    .use(createPinia())
    .use(Toast, {
        position: 'top-right',
        timeout: 3000
    })
    .mount('#app')