$(function(){
    var vm = new Vue({
        el: '#submission',

        data: {
            submission: window.$data.submission,
            statuses: window.$data.statuses,
            locale: window.$data.locale
        },

        watch: {
            'submission.status': {
                handler: function(val, oldVal) {
                    this.save();
                },
                deep: true
            }
        },

        methods: {
            dateFormat: function(date){
                return moment(date.date).locale(this.locale).format('dddd do MMMM YYYY, HH:mm:ss');
            },
            moneyFormat: function(amount){
                return amount;
            },
            save: function(){
                this.$http.post('admin/money-support/update-submission', { submission: {id: this.submission.id, status: this.submission.status }}, function(message) {
                    UIkit.notify(vm.$trans('Saved'), '');
                }).error(function(data) {
                    UIkit.notify(data, 'danger');
                });
            }
        }
    });
});