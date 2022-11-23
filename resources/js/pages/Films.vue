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
                            <span class="bg-white text-black cursor-pointer text-sky-500 hover:text-sky-800 hover:underline hover:decoration-1" @click="queryId = film.imdbID, fetchId()">
                                imbdID: {{ film.imdbID }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="filmId">
            <div class="container">
                <div class="card">
                    <div class="img-container flex justify-center bg-black">
                        <img :src="filmId.Poster" :alt="filmId.Title" class="object-cover">
                    </div>
                    <div class="desc flex flex-col gap-3 p-3 bg-white">
                        <span class="bg-white text-black">
                            Titolo: {{ filmId.Title }}
                        </span>
                        <span class="bg-white text-black">
                            Tipo: {{ filmId.Type }}
                        </span>
                        <span class="bg-white text-black">
                            Anno: {{ filmId.Year }}
                        </span>
                        <span class="bg-white text-black">
                            imbdID: {{ filmId.imdbID }}
                        </span>
                        <span class="bg-white text-black">
                            Attori: {{ filmId.Actors }}
                        </span>
                        <span class="bg-white text-black">
                            Paese: {{ filmId.Country }}
                        </span>
                        <span class="bg-white text-black">
                            Genere: {{ filmId.Genre }}
                        </span>
                        <span class="bg-white text-black">
                            Lingua originale: {{ filmId.Language }}
                        </span>
                        <span class="bg-white text-black">
                            Trama: {{ filmId.Plot }}
                        </span>
                        <span class="bg-white text-black">
                            imdbRating: {{ filmId.imdbRating }}
                        </span>
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
            films: null,
            filmId: null,
        }
    },
    methods: {
        fetchFilm(bool) {
            let par;
            this.films = null;
            this.filmId = null;
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
                        this.filmId = res.data.json;
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
                    this.films = res.data.json.Search;
                    console.log(this.films);
                    // console.log(res);
                }).catch(err =>{
                    console.log(err);
                });
            }
            this.invalidInput = false;
        },
        fetchId(){
            this.films = null;
            this.filmId = null;
            let par = this.queryId;
            axios.get(`/api/films/id/${par}`)
            .then(res => {
                if(res.data.json.Response === "False") {
                    this.invalidInput = true;
                    this.invalidMsg = 'Id non valido!';
                    console.log(res);
                    return;
                }
                    this.filmId = res.data.json;
                    console.log(res);
    
            }).catch(err =>{
                console.log(err);
            });
        },
    }
}
</script>

<style>

</style>