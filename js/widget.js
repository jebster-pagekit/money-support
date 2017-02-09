$(function(){
    var vm = new Vue({
        el: '#moneysupport',

        data: {
            selectedAmount: defaultAmount,
            otherAmount: false,
            amountPossibilities: amountPossibilities,
            toOptions: towards,
            form: {
                amount: defaultAmount,
                towards: 'loading',
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

        computed: {
            moneyOptions: function(){
                var options = this.amountPossibilities.split(',');
                options.push(this.$trans('Other amount'));
                return options;
            },
            towardOptions: function(){
                var options = this.toOptions.split(',');
                this.form.towards = options[0];
                return options;
            }
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
            },

            onChange: function () {
                if(this.moneyOptions.indexOf(this.selectedAmount)<this.moneyOptions.length-1) {
                    this.form.amount = this.selectedAmount;
                    this.otherAmount = false;
                }
                else
                    this.otherAmount = true;
            }
        }
    });
});