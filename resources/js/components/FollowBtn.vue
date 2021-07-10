<template>
    <div>
        <button class="btn btn-sm btn-no-outline font-weight-bold" v-bind:class="buttonClass" @click="followUser"
                v-text="buttonText"></button>
    </div>
</template>

<script>
export default {
    props: ['username', 'follow', 'display'],
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
            return this.status ? 'Following' : 'Follow';
        },
        buttonClass() {
            switch (this.display) {
                case 'pc':
                    return this.status ? 'btn-outline-black' : 'btn-primary';
                    break;
                case 'mobile':
                    return this.status ? 'btn-outline-black w-100' : 'btn-primary w-100';
                    break;
                case 'home':
                    return this.status ? 'btn-link-black text-decoration-none p-0' : 'btn-link text-decoration-none p-0';
                    break;
                default:
                    return this.status ? 'btn-outline-black' : 'btn-primary';
            }
        }
    }
}
</script>
