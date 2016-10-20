var App = Vue.extend({
    template: '<theme-header></theme-header>' +
              '<div class="container"><router-view></router-view></div>' +
              '<theme-footer></theme-footer>',

    ready() {
        this.updateTitle('');
    },

    methods: {
        updateTitle(pageTitle) {
            document.title = (pageTitle ? pageTitle + ' - ' : '') + wp.site_name;
        }
    },

    events: {
        'page-title': function(pageTitle) {
            this.updateTitle(pageTitle);
        }
    }
});
