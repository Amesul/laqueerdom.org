import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';
import sort from '@alpinejs/sort';
import collapse from '@alpinejs/collapse'

Alpine.plugin(sort);
Alpine.plugin(focus);
Alpine.plugin(persist);
Alpine.plugin(collapse)

window.Alpine = Alpine;
Alpine.start();
