<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/Logos/ApplicationLogo.vue";
import Tyndall from "@/Components/Effects/Tyndall.vue";
import Particles from "@/Components/Effects/Particles.vue";
import GeneratedText from "@/Components/Effects/GeneratedText.vue";
import TextLink from "@/Components/Texts/TextLink.vue";
import {PhHourglass, PhLink, PhLockSimple, PhLockSimpleOpen} from "@phosphor-icons/vue";
import LaravelLogo from "@/Components/Logos/LaravelLogo.vue";
import TailwindLogo from "@/Components/Logos/TailwindLogo.vue";
import InertiaLogo from "@/Components/Logos/InertiaLogo.vue";
import VueLogo from "@/Components/Logos/VueLogo.vue";
import GlareCard from "@/Components/Cards/GlareCard.vue";
import Card from "@/Components/Cards/Card.vue";
import Footer from "@/Components/Footer.vue";
import ShimmerText from "@/Components/Texts/ShimmerText.vue";

const title = "your links in disguise";
</script>

<template>
    <Head :title="title"/>

    <Tyndall streak-color="#fff">
        <Particles
            :density="500"
            class="absolute inset-x-0 bottom-0 h-full w-full [mask-image:radial-gradient(100%_100%,white,transparent_80%)]"
        />
        <div
            class="flex flex-col items-center justify-start gap-24 pb-6 min-h-screen bg-gradient-to-br from-gray-950 to-gray-800 text-indigo-50">

            <div
                class="flex flex-col items-center justify-center mt-16 fill-indigo-50 motion-preset-focus motion-duration-2000 z-10">
                <ApplicationLogo class="w-56"/>
            </div>

            <div class="flex flex-col items-center w-7/12 gap-4">

                <div
                    class="rounded-full px-4 py-1 border border-gray-50/10 bg-gray-950"
                >
                    <ShimmerText>
                        Generate Encrypted Links
                    </ShimmerText>
                </div>

                <GeneratedText
                    words="Teleport your links securely through the magic of Floo network"
                    class="text-4xl font-bold font-title"
                />
                <div class="text-lg font-regular text-center">
                    Inspired by the
                    <TextLink url="https://harrypotter.fandom.com/wiki/Floo_Network">magical
                        fireplaces
                    </TextLink>
                    in Harry Potter that transport wizards safely, Floolink teleports your URLs using advanced
                    <TextLink url="https://en.wikipedia.org/wiki/Advanced_Encryption_Standard">AES-256 encryption
                    </TextLink>
                    ,
                    transforming them into protected links ready to share. Make your links disappear from
                    prying eyes and reappear exactly where you need them – safe, secure, and magical.
                </div>
            </div>

            <div class="flex flex-col items-center gap-4">
                <div class="text-4xl font-bold font-title">
                    The spells you can cast
                </div>

                <div class="grid grid-cols-2 grid-rows-2 gap-4">
                    <Card>
                        <div class="p-4">
                            <div class="flex items-center gap-2">
                                <PhLockSimple :size="32" color="#4338CA" weight="duotone"/>
                                <div class="font-semibold font-title text-lg">Protego Linkium</div>
                            </div>
                            <div>
                               Paste, encrypt, and send your links safely.
                            </div>
                        </div>
                    </Card>
                    <Card>
                        <div class="p-4">
                            <div class="flex items-center gap-2">
                                <PhLockSimpleOpen :size="32" color="#4338CA" weight="duotone"/>
                                <div class="font-semibold font-title text-lg">Revelio Linkium</div>
                            </div>
                            <div>
                                Did you receive a floolink? Decrypt it here!
                            </div>
                        </div>
                    </Card>
                    <Card class="row-start-2">
                        <div class="p-4">
                            <div class="flex items-center gap-2">
                                <PhHourglass :size="32" color="#4338CA" weight="duotone"/>
                                <div class="font-semibold font-title text-lg">Evanesco Tempus</div>
                            </div>
                            <div>
                                Links that vanish when you want. Magic!
                            </div>
                        </div>
                    </Card>
                    <Card class="row-start-2">
                        <div class="p-4">
                            <div class="flex items-center gap-2">
                                <PhLink :size="32" color="#4338CA" weight="duotone"/>
                                <div class="font-semibold font-title text-lg">Wingardium Linkiosa</div>
                            </div>
                            <div>
                                Generate and share floolinks effortlessly.
                            </div>
                        </div>
                    </Card>
                </div>
            </div>

            <div class="flex flex-col items-center gap-4">
                <div class="text-4xl font-bold font-title">
                    Built with all the modern technologies
                </div>

                <div class="flex items-center gap-4">
                    <GlareCard
                        title="Vue.js"
                        :width="200"
                        :height="130"
                        class="flex flex-col items-center justify-center">
                        <VueLogo class="w-16"/>
                    </GlareCard>

                    <GlareCard
                        title="Inertia.js"
                        :width="200"
                        :height="130"
                        class="flex flex-col items-center justify-center">
                        <InertiaLogo class="w-16 fill-gray-800"/>
                    </GlareCard>

                    <GlareCard
                        title="Laravel"
                        :width="200"
                        :height="130"
                        class="flex flex-col items-center justify-center">
                        <LaravelLogo class="w-16 fill-gray-800"/>
                    </GlareCard>

                    <GlareCard
                        title="Tailwind CSS"
                        :width="200"
                        :height="130"
                        class="flex flex-col items-center justify-center">
                        <TailwindLogo class="w-16 fill-gray-800"/>
                    </GlareCard>
                </div>
            </div>

            <Footer/>
        </div>
    </Tyndall>
</template>

<style scoped>

</style>
