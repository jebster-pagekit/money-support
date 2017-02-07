$(function(){
    var vm = new Vue({
        el: '#settings',

        data: {
            config: window.$data.config,
            paypal: window.$data.config.paypal
        },

        methods: {
            save: function () {
                this.$http.post('/admin/money-support/update-settings', { config: this.config}, function() {
                    UIkit.notify(vm.$trans('Saved'), '');
                }).error(function(data) {
                    UIkit.notify(data, 'danger');
                });
            }
        }
    });
});