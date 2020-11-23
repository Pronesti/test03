<template>
    <div class="">
        <img v-bind:src="buttonImg" style="max-width: 1.5rem;" @click="followUser"/>
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
            followUser(){
                axios.post('/like/' + this.postId)
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
            buttonImg(){
                return (this.status) ? '/img/heart-on.svg' : '/img/heart-off.svg';
            }
        }
    }
</script>
