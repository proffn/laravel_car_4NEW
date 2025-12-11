// Загружаем jQuery и делаем его глобальным
const $ = require('jquery');
window.$ = window.jQuery = $;

// Загружаем Bootstrap
const bootstrap = require('bootstrap');
window.bootstrap = bootstrap;

// Импортируем SASS стили
require('../sass/app.scss');


document.addEventListener('DOMContentLoaded', () => {
    console.log('Приложение загружено');
});