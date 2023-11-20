<template>
    <div>
        <Head title="TMDB"/>

        <Heading class="mb-6">TMDB Popular Movies</Heading>

        <Card
            class="mb-6 movie-container"
        >
            <div v-for="movie in data.items" :key="movie.id" class="movie-card flex flex-col justify-between">
                <img :src="'https://image.tmdb.org/t/p/w500' + movie.poster_path" alt="" class="w-15">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <h2 class="text-xl font-bold mb-2">{{ movie.title }}</h2>
                        <p class="max-w-2xl text-justify mb-2">{{ movie.overview }}</p>
                    </div>
                    <div class="mt-auto">
                        <span>Rating: </span>
                        <span v-html="generateStarRating(movie.vote_average)"></span>
                        <span> ({{ (movie.vote_average * 10).toFixed(2) }}%)</span>
                        <p>Release Date: {{ moment(movie.release_date).format('MMMM DD, YYYY') }}</p>
                    </div>
                </div>
            </div>

        </Card>
    </div>
</template>

<script setup>

import { onMounted, reactive } from 'vue'
import moment from 'moment'

const data = reactive({
    items: [],
})

const generateStarRating = (rating) => {

    let roundedRating = Math.round(rating / 2 + (.45))

    roundedRating = Math.min(Math.max(roundedRating, 0), 5)

    let starIcons = '★'.repeat(Math.floor(roundedRating))

    if (roundedRating % 1 !== 0) {
        starIcons += '<span class="half-star">½</span>'
    }

    starIcons += '☆'.repeat(5 - Math.ceil(roundedRating))

    return starIcons
}

onMounted(() => {
    Nova.request().get('/nova-vendor/tmdb/')
        .then(response => {
            data.items = response.data
        })
})
</script>

<style scoped>
.half-star {
    font-size: 0.8em;
}

.movie-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.movie-card {
    width: calc(25% - 16px);
    margin-bottom: 16px;
}

.text-justify {
    text-align: justify;
}

</style>
