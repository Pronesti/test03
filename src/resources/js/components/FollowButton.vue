<template>
    <div class="">
        <button :class="buttonClass" @click="followUser" v-text="buttonText"></button>
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
                            if(error.response.status == 401){
                                window.location = '/users/login'
                            }
                        });
            }
        },
        computed: {
            buttonText(){
                return (this.status) ? 'Siguiendo' : 'Seguir';
            },
            buttonClass(){
                return (this.status) ? 'btn btn-outline-secondary' : 'btn btn-primary';
            }
        }
    }
</script>
