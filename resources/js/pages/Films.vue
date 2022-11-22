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
        fetchFilm() {
            axios.get('https://www.omdbapi.com/?apikey=bd966b35&t=blade')

            .then(res => {
                    console.log(res);
            }).catch(err =>{
                console.log('BOH2');
            });
        }
    },
    beforeMount() {
        this.fetchFilm();
    }
}
</script>

<style>

</style>