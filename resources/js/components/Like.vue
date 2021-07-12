<template>
    <div>
        <button class="btn btn-clear p-0" @click="likePost">
            <i class="font-size-25 fa-heart" v-bind:class="heartClass"></i>
        </button>
        <br>
        <strong v-text="countText"></strong>
    </div>
</template>

<script>
export default {
    props: ['like', 'count', 'id'],
    mounted() {

    },
    data: function () {
        return {
            status: this.like,
            number: +this.count
        }
    },
    methods: {
        likePost() {
            axios.post('/like/' + this.id)
                .then(res => {
                    this.status = !this.status;
                    console.log(res.data)
                    this.number = this.status ? this.number + 1 : this.number - 1
                })
                .catch(err => {
                        if (err.response.status == 401) {
                            window.location = '/login';
                        }
                    }
                )
        }
    }
    ,
    computed: {
        countText() {
            return (this.number > 1) ? this.number + ' likes' : (this.number === 1) ? this.number + ' like' : '';
        },
        heartClass() {
            return this.status ? 'fas text-danger' : 'far';
        }
    }
}
</script>
