$(function(){
    var vm = new Vue({
        el: '#moneysupport',

        data: {
            form: {
                amount: defaultAmount,
                name: '',
                email: '',
                bank: ''
            },
            message: {
                text: '',
                success: false
            },
            sent: false
        },

        methods: {
            send: function(){
                if(!this.sent){
                    this.$http.post('money-support/send', { submission: this.form}, function(message) {
                        this.message.text = vm.$trans('Sent');
                        this.message.success = true;
                        this.sent = true;
                    }).error(function(data) {
                        this.message.text = data; //vm.$trans("");
                        this.message.success = false
                    });
                }else{
                    this.message.text = vm.$trans('You have already sent.');
                    this.message.success = false;
                }
            }
        }
    });
});