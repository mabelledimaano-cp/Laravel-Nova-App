<template>
    <div>
        <Head title="TMDB"/>

        <Heading class="mb-6">TMDB Popular Movies</Heading>

        <Card
            class="mb=6"
        >
            <div v-for="movie in data.items" :key="movie.id">
                <img :src="'https://image.tmdb.org/t/p/w500' + movie.poster_path" alt="">
                <h2>{{ movie.title }}</h2>
                <p>{{ movie.overview }}</p>
                <!-- Add other movie details as needed -->
            </div>
        </Card>
    </div>
</template>

<script setup>

import { onMounted, reactive } from 'vue'

const data = reactive({
    items: [],
})

onMounted(() => {
    Nova.request().get('/nova-vendor/tmdb/')
        .then(response => {
            data.items = response.data
        })
})
</script>

<style>
/* Scoped Styles */
</style>
