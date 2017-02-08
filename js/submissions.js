$(function(){
    var vm = new Vue({
        el: '#submissions',

        data: {
            submissions: window.$data.submissions,
            statuses: window.$data.statuses,
            locale: window.$data.locale
        },

        methods: {
            dateFormat: function(date){
                return moment(date.date).locale(this.locale).format('ddd do MMMM YYYY, HH:mm:ss');
            }
        }
    });
});