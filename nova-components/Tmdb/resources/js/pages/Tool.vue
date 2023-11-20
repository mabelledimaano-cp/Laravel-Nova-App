<template>
    <div>
        <Head title="TMDB"/>

        <Heading class="mb-6">TMDB Popular Movies</Heading>

        <Card
            class="mb-6 movie-container"
        >
            <div v-for="movie in data.items" :key="movie.id" class="movie-card">
                <img :src="'https://image.tmdb.org/t/p/w500' + movie.poster_path" alt="">
                <h2>{{ movie.title }}</h2>
                <p>{{ movie.overview }}</p>
                <span>Rating: </span>
                <span v-html="generateStarRating(movie.vote_average)"></span>
                <span> ({{ (movie.vote_average * 10).toFixed(2) }}%)</span>
                <p> Release Date: {{ moment(movie.release_date).format('MMMM DD, YYYY') }}</p>

                <!-- Add other movie details as needed -->
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
    // Scale the rating from 0-10 to the 0-5 star system
    let roundedRating = Math.round(rating / 2 + (.45))

    // Ensure the roundedRating is within the valid range of 0 to 5
    roundedRating = Math.min(Math.max(roundedRating, 0), 5)

    let starIcons = '★'.repeat(Math.floor(roundedRating))

    if (roundedRating % 1 !== 0) {
        // If there's a decimal part, add a half star
        starIcons += '<span class="half-star">½</span>'
    }

    // Add empty stars for the remaining space
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
    font-size: 0.8em; /* Adjust the font size as needed */
}

.movie-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.movie-card {
    width: calc(25% - 16px); /* Adjust the width based on your design, considering margins */
    margin-bottom: 16px; /* Add margin for spacing between cards */
}

</style>
