// require('./bootstrap');
import '../sass/app.scss'
import * as bootstrap from "bootstrap";

import Alpine from 'alpinejs';

import focus from '@alpinejs/focus'
import mask from '@alpinejs/mask'

Alpine.plugin(focus)
Alpine.plugin(mask)

window.Alpine = Alpine;

Alpine.start();
