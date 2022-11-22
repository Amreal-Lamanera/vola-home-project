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
        }
    },
    methods: {
        fetchPost() {
            axios.get('https://www.omdbapi.com/?apikey=bd966b35&t=blade',{
                mode: "no-cors"
            })

            .then(res => {
                    console.log(res);
            }).catch(err =>{
                console.log('BOH2');
            });
        }
    },
    beforeMount() {
        this.fetchPost();
    }
}
</script>

<style>

</style>