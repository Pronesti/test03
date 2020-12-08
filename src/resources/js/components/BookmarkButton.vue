<template>
    <div class="">
        <img v-bind:src="buttonImg" style="max-width: 1.5rem;" @click="savePost"/>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'saved'],
        data: function(){
            return {
                status: this.saved,
            }
        },
        methods: {
            savePost(){
                axios.post('/bookmark/' + this.postId)
                    .then(response => {
                        this.status = !this.status
                        console.log(response.data)
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
                return (this.status) ? '/img/bookmark-on.svg' : '/img/bookmark-off.svg';
            }
        }
    }
</script>
