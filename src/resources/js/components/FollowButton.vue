<template>
    <div class="">
        <div class="w-100" :class="buttonClass" @click="followUser" v-text="buttonText"></div>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],
        data: function(){
            return {
                status: this.follows,
            }
        },
        methods: {
            followUser(){
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        this.status = !this.status
                        })
                        .catch(errors => {
                            console.log(errors);
                            if(errors.response.status == 401){
                                window.location = '/users/login'
                            }
                        });
            }
        },
        computed: {
            buttonText(){
                return (this.status) ? 'Following' : 'Follow';
            },
            buttonClass(){
                return (this.status) ? 'border border-light rounded p-1' : 'btn btn-primary';
            }
        }
    }
</script>
