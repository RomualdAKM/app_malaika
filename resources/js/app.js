import './bootstrap';

import { createApp } from 'vue'
import app from './pages/app.vue'
import router from './router/index'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

createApp(app).use(router).mount('#app')