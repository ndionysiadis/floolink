<script setup lang="ts">
import Particles from "@/Components/Effects/Particles.vue";
import {Head} from "@inertiajs/vue3";

const title = "404: Link Not Found";
</script>

<template>
    <Head :title="title"/>
    <Particles
        :density="500"
        class="absolute inset-x-0 bottom-0 h-full w-full [mask-image:radial-gradient(100%_100%,white,transparent_80%)]"
    />

</template>
