<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Tyndall from "@/Components/Effects/Tyndall.vue";
import Particles from "@/Components/Effects/Particles.vue";
import GeneratedText from "@/Components/Effects/GeneratedText.vue";
import TextLink from "@/Components/TextLink.vue";
import Card from "@/Components/Card.vue";
import {PhHourglass, PhLockSimple, PhLockSimpleOpen} from "@phosphor-icons/vue";

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
            class="flex flex-col items-center justify-start gap-32 min-h-screen bg-gradient-to-br from-gray-950 to-gray-800 text-white fill-white">
            <div class="flex flex-col items-center justify-center mt-16 motion-preset-focus motion-duration-2000 z-10">
                <ApplicationLogo class="w-56"/>
            </div>

            <div class="flex flex-col items-center w-7/12 gap-6">
                <div
                    class="text-md font-regular tracking-widest bg-gradient-to-b from-pink-300 to-rose-400 bg-clip-text text-transparent">
                    Generate Encrypted Links
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


            <div class="grid grid-cols-2 grid-rows-2 gap-4">
                <Card>
                    <div class="p-4">
                        <div class="flex items-center gap-2">
                            <PhLockSimple :size="32" color="#f472b6" weight="duotone"/>
                            <div class="font-semibold font-title text-lg">Encrypt your links</div>
                        </div>
                        <div>
                            Paste, encrypt and send your links safely.
                        </div>
                    </div>
                </Card>
                <Card>
                    <div class="p-4">
                        <div class="flex items-center gap-2">
                            <PhLockSimpleOpen :size="32" color="#f472b6" weight="duotone"/>
                            <div class="font-semibold font-title text-lg">Decrypt your links</div>
                        </div>
                        <div>
                            Did you receive a floolink? Decrypt it here!
                        </div>
                    </div>
                </Card>
                <Card class="row-start-2">
                    <div class="p-4">
                        <div class="flex items-center gap-2">
                            <PhHourglass :size="32" color="#f472b6" weight="duotone"/>
                            <div class="font-semibold font-title text-lg">Set expiration time</div>
                        </div>
                        <div>
                            Links that vanish when you want. Magic!
                        </div>
                    </div>
                </Card>
                <Card class="row-start-2">
                    <div class="p-4">
                        <div class="flex items-center gap-2">
                            <PhHourglass :size="32" color="#f472b6" weight="duotone"/>
                            <div class="font-semibold font-title text-lg">Set expiration time</div>
                        </div>
                        <div>
                            Links that vanish when you want. Magic!
                        </div>
                    </div>
                </Card>
            </div>

            <div class="text-4xl font-bold font-title">
                Built with all the modern technologies
            </div>
        </div>
    </Tyndall>
</template>

<style scoped>

</style>
