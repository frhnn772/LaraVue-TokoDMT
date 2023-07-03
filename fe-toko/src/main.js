import { createApp } from 'vue'
import router from './router'
import App from './App.vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.js'
import 'bootstrap-icons/font/bootstrap-icons.css'

// createApp(App).mount('#app')
const app = createApp(App)
app.use(router)
app.mount('#app')
