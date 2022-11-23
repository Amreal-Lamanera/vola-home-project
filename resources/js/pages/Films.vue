<template>
    <main class="p-6">

        <SearchSectionVue />

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
                            <span class="bg-white text-black cursor-pointer text-sky-500 hover:text-sky-800 hover:underline hover:decoration-1" @click="fetchId(film.imdbID)">
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
import SearchSectionVue from "../components/SearchSection"
import state from '../store'

export default {
    components: {
        SearchSectionVue
    },
    data() {
        return {
        }
    },
    computed: {
        films() {
            return state.films;
        },
        filmId() {
            return state.filmId;
        },
    },
    methods: {
        fetchId(id){
            state.films = null;
            state.filmId = null;
            let par = id;
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
        },
    },
}
</script>

<style>

</style>