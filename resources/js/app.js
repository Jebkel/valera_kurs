import './bootstrap';

import Alpine from 'alpinejs';
import axios from 'axios'


window.axios = axios;

axios.defaults.withCredentials = true;


window.Alpine = Alpine;

Alpine.start();
