/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-resource'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Common components
Vue.component('footer-component', require('./components/parts/FooterComponent.vue').default);
Vue.component('common-navbar-component', require('./components/parts/CommonNavbarComponent.vue').default);
Vue.component('categories-component', require('./components/parts/CategoriesComponent.vue').default);
Vue.component('search-bar-component', require('./components/parts/SearchBarComponent.vue').default);
Vue.component('social-links-sidebar-component', require('./components/parts/SocialLinksSidebarComponent.vue').default);

// Components of home page
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);
Vue.component('article-component', require('./components/ArticleComponent.vue').default);

// Pagination component
Vue.component('pagination', require('laravel-vue-pagination'));

// Components of news page
Vue.component('news-component', require('./components/news/NewsComponent.vue').default);
Vue.component('news-by-category-component', require('./components/news/NewsByCategoryComponent.vue').default);
Vue.component('single-news-component', require('./components/news/SingleNewsComponent.vue').default);

// Components of articles page
Vue.component('articles-component', require('./components/articles/ArticlesComponent.vue').default);
Vue.component('articles-by-category-component', require('./components/articles/ArticlesByCategoryComponent.vue').default);
Vue.component('single-article-component', require('./components/articles/SingleArticleComponent.vue').default);

// Components of discussions page
Vue.component('discussions-component', require('./components/discussions/DiscussionsComponent.vue').default);
Vue.component('discussions-categories-component', require('./components/discussions/CategoriesSidebarComponent.vue').default);
Vue.component('ask-question-btn-component', require('./components/discussions/AskQuestionButtonComponent.vue').default);
Vue.component('discussions-by-category-component', require('./components/discussions/DiscussionsByCategoryComponent.vue').default);
Vue.component('single-discussion-component', require('./components/discussions/SingleDiscussionComponent.vue').default);

// Components of login page
Vue.component('login-form-component', require('./components/auth/login/LoginFormComponent.vue').default);

// Components of register page
Vue.component('register-form-component', require('./components/auth/register/RegisterFormComponent.vue').default);

// Components from auth/verify folder
Vue.component('verify-email-component', require('./components/auth/verify/VerifyEmailAddressComponent.vue').default);

// Password components (auth/password)
Vue.component('confirm-password-component', require('./components/auth/password/ConfirmComponent.vue').defualt);
Vue.component('email-confirm-component', require('./components/auth/password/EmailComponent.vue').default);
Vue.component('reset-password-component', require('./components/auth/password/ResetComponent.vue').default);


// Admin components

// Common parts
Vue.component('admin-navbar-component', require('./components/admin/parts/NavbarComponent.vue').default);
Vue.component('admin-collapsible-sidebar-component', require('./components/admin/parts/CollapsibleSidebarComponent.vue').default);
Vue.component('admin-footer-component', require('./components/admin/parts/FooterComponent.vue').default);

// Dashboard components
Vue.component('users-list-component', require('./components/admin/dashboard/UsersListComponent.vue').default);

// News components
Vue.component('news-table-component', require('./components/admin/news/NewsTableComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

const news = new Vue({
    el: '#news' 
});

const articles = new Vue({
    el: '#articles' 
});

const discussions = new Vue({
    el: '#discussions'
});

const admin = new Vue({
    el: '#dashboard'
});