<template>
    <div>
        <button class="btn btn-sm btn-no-outline" v-bind:class="buttonClass" @click="followUser"
                v-text="buttonText"></button>
    </div>
</template>

<script>
export default {
    props: ['username', 'follow', 'device'],
    mounted() {
        console.log('Component mounted.')
    },
    data: function () {
        return {
            status: this.follow,
        }
    },
    methods: {
        followUser() {
            axios.post('/follow/' + this.username)
                .then(res => {
                    this.status = !this.status;
                    console.log(res.data);
                })
                .catch(err => {
                    if (err.response.status == 401) {
                        window.location = '/login';
                    }
                })
        }
    }
    ,
    computed: {
        buttonText() {
            return this.status ? 'Unfollow' : 'Follow';
        },
        buttonClass() {
            if (this.device === 'pc') return this.status ? 'btn-outline-black' : 'btn-primary';
            return this.status ? 'btn-outline-black w-100' : 'btn-primary w-100';
        }
    }
}
</script>
