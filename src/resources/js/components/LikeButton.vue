<template>
    <div class="">
        <img v-bind:src="buttonImg" style="max-width: 1.5rem;" @click="likePost"/>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'likes'],
        data: function(){
            return {
                status: this.likes,
            }
        },
        methods: {
            likePost(){
                axios.post('/like/p/' + this.postId)
                    .then(response => {
                        this.status = !this.status
                        })
                        .catch(error => {
                            if(error.response.status == 401){
                                window.location = '/users/login'
                            }
                        });
            }
        },
        computed: {
            buttonImg(){
                return (this.status) ? '/img/heart-on.svg' : '/img/heart-off.svg';
            }
        }
    }
</script>
