<template>
  <div>

  </div>
</template>

<script>
export default {
    data: () => ({
        users: []
    }),
    methods: {
        initialize () {
            axios.get('/api/my-account')
                .then(response => console.log(response))
            .catch(err => {
                console.log(err.data.response)
            })
        }
    },
    created () {
        this.initialize();
    }
}
</script>

<style>

</style>
