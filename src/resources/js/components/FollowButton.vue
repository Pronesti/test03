<template>
    <div class="">
        <button class="btn btn-primary" @click="followUser" v-text="buttonText"></button>
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
                        console.log(response.data)
                        if(response.data == 'NotLogged'){
                                window.location = '/login'
                            }
                        this.status = !this.status
                        })
                        .catch(errors => {
                            console.log(errors);
                        });
            }
        },
        computed: {
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
