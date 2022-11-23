<template>
  <section>
            <div class="container">
                <div class="flex pb-6 justify-end gap-4 items-center">
                    <label class="mb-0" for="title">Ricerca per titolo:</label>
                    <input name="title" type="text" placeholder="Cerca per titolo..." v-model="queryTitle" @keyup.enter="fetchFilm(0)" ref="searchBar" class="focus-visible:outline-none rounded-sm border-2" :class="invalidInput ? 'border-rose-500' : ''">
                    <button class="rounded-md bg-white p-1 text-black" @click="fetchFilm(0)">Cerca</button>
                </div>
                <div class="flex justify-end gap-4 items-center pb-6">
                    <label class="mb-0" for="id">Ricerca per id:</label>
                    <input name="id" type="text" placeholder="Cerca per id..." v-model="queryId" @keyup.enter="fetchFilm(1)" ref="searchBar" class="focus-visible:outline-none rounded-sm border-2" :class="invalidInput ? 'border-rose-500' : ''">
                    <button class="rounded-md bg-white p-1 text-black" @click="fetchFilm(1)">Cerca</button>
                </div>
                <div v-if="invalidInput" class="flex justify-end">
                    {{ invalidMsg }}
                </div>
            </div>
        </section>
</template>

<script>
import state from '../store'

export default {
    data() {
        return {
            invalidInput: false,
            invalidMsg: '',
            queryTitle: '',
            queryId: '',
        }
    },
    methods: {
        fetchFilm(bool) {
            let par;
            state.films = null;
            state.filmId = null;
            if(bool) {
                if (this.queryId.trim() === ''){
                    this.invalidInput = true;
                    this.invalidMsg = 'Input id vuoto!';
                    return;
                }
                par = this.queryId;
                axios.get(`/api/films/id/${par}`)
                .then(res => {
                    if(res.data.json.Response === "False") {
                        this.invalidInput = true;
                        this.invalidMsg = 'Id non valido!';
                        console.log(res);
                        return;
                    }
                        state.filmId = res.data.json;
                        console.log(res);

                }).catch(err =>{
                    console.log(err);
                });
            }
            else {
                if (this.queryTitle.trim() === ''){
                    this.invalidInput = true;
                    this.invalidMsg = 'Input titolo vuoto!';
                    return;
                }
                par = this.queryTitle;
                axios.get(`/api/films/${par}`)
                .then(res => {
                    if(res.data.json.Response === "False") {
                        this.invalidInput = true;
                        this.invalidMsg = 'Film non trovato!';
                        return;
                    }
                    state.films = res.data.json.Search;
                    console.log('state: ', state.films);
                    // console.log(res);
                }).catch(err =>{
                    console.log(err);
                });
            }
            this.invalidInput = false;
        },
    }
}
</script>

<style>

</style>