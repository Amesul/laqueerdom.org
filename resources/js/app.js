import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';
import sort from '@alpinejs/sort';

Alpine.plugin(sort);
Alpine.plugin(focus);
Alpine.plugin(persist);

window.Alpine = Alpine;
Alpine.start();
