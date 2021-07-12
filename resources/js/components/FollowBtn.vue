<template>
    <div>
        <button class="btn btn-sm btn-no-outline font-weight-bold"
                v-bind:class="buttonClass" @click="followUser"
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
                    return this.status ? 'btn-outline-black font-size-14' : 'btn-primary font-size-14';
                    break;
                case 'mobile':
                    return this.status ? 'btn-outline-black w-100 font-size-14' : 'btn-primary w-100 font-size-14';
                    break;
                case 'home':
                    return this.status ? 'btn-link-black btn-clear text-decoration-none p-0 font-size-12' : 'btn-link btn-clear text-decoration-none p-0 font-size-12';
                    break;
                default:
                    return this.status ? 'btn-outline-black font-size-14' : 'btn-primary font-size-14';
            }
        }
    }
}
</script>
