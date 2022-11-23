<template>
    <main class="p-6">

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

        <section v-if="films">
            <div class="container">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card" v-for="film,i in films" :key="i">
                        <img :src="film.Poster" :alt="film.Title" class="object-cover h-96">
                        <div class="desc flex flex-col gap-3 p-3 bg-white">
                            <span class="bg-white text-black">
                                Titolo: {{ film.Title }}
                            </span>
                            <span class="bg-white text-black">
                                Tipo: {{ film.Type }}
                            </span>
                            <span class="bg-white text-black">
                                Anno: {{ film.Year }}
                            </span>
                            <span class="bg-white text-black">
                                imbdID: {{ film.imdbID }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
</template>

<script>
export default {
    data() {
        return {
            queryTitle: '',
            queryId: '',
            invalidInput: false,
            invalidMsg: '',
            films: null
        }
    },
    methods: {
        fetchFilm(bool) {
            let par;
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
                        return;
                    }
                        this.films = res.data.json.Search;
                        // console.log(res);

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
                    this.films = res.data.json.Search;
                    console.log(this.films);
                    // console.log(res);
                }).catch(err =>{
                    console.log(err);
                });
            }
            this.invalidInput = false;
        }
    },
}
</script>

<style>

</style>