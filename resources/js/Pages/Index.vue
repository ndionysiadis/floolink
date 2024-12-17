<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import TyndallBackground from "@/Components/TyndallBackground.vue";
import VortexBackground from "@/Components/VortexBackground.vue";
import FlipWords from "@/Components/FlipWords.vue";

const title = "tiny links, big protection";
</script>

<template>
    <Head :title="title"/>

    <div class="bg-gray-950">
        <TyndallBackground streak-color="#fff"
                           class="flex flex-col justify-start min-h-screen bg-gradient-to-br from-gray-950 to-gray-800 text-white fill-white">

            <VortexBackground
                background-color="transparent"
                :base-hue="-1"
                class="flex flex-col items-center mt-12"
            >
                <ApplicationLogo class="w-56"/>
                <div class="text-md font-regular font-title tracking-widest">
                    your links in disguise
                </div>
            </VortexBackground>

            <div class="text-4xl font-bold text-center">
                Your Links, Now
                <div class="inline-block w-[12rem]">
                    <FlipWords
                        :words="['Masked', 'Protected', 'Sealed']"
                        :duration="3000"
                        class="text-4xl !text-pink-400"
                    />
                </div>
            </div>

        </TyndallBackground>
    </div>
</template>

<style scoped>

</style>
