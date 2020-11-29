<template>
    <div class="">
        <img v-bind:src="buttonImg" width="18" alt="LikeComment" @click="likeComment"/>
    </div>
</template>

<script>
    export default {
        props: ['commentId', 'likes'],
        data: function(){
            return {
                status: this.likes,
            }
        },
        methods: {
            likeComment(){
                axios.post('/like/c/' + this.commentId)
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
