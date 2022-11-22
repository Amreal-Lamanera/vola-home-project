<template>
    <div>
        <section>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // title: 'HOME PAGE',
        }
    },
    methods: {
        fetchPost() {
            axios.get(`http://www.omdbapi.com/?apikey=bd966b35&t=signore&r=xml`).then(res => {
                console.log(res);
            }).catch(err =>{
                console.log('BOH2');
            })
        }
    },
    beforeMount() {
        this.fetchPost();
    }
}
</script>

<style>

</style>