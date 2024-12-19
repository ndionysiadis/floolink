<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/Logos/ApplicationLogo.vue";
import Tyndall from "@/Components/Effects/Tyndall.vue";
import Particles from "@/Components/Effects/Particles.vue";
import GeneratedText from "@/Components/Effects/GeneratedText.vue";
import TextLink from "@/Components/Texts/TextLink.vue";
import {PhHourglass, PhLink, PhLockSimple, PhLockSimpleOpen, PhSparkle} from "@phosphor-icons/vue";
import LaravelLogo from "@/Components/Logos/LaravelLogo.vue";
import TailwindLogo from "@/Components/Logos/TailwindLogo.vue";
import InertiaLogo from "@/Components/Logos/InertiaLogo.vue";
import VueLogo from "@/Components/Logos/VueLogo.vue";
import GlareCard from "@/Components/Cards/GlareCard.vue";
import Card from "@/Components/Cards/Card.vue";
import Footer from "@/Components/Footer.vue";
import ShimmerText from "@/Components/Texts/ShimmerText.vue";
import LinkInput from "@/Components/Inputs/LinkInput.vue";
import GenerativeButton from "@/Components/Buttons/GenerativeButton.vue";
import { useHead } from "@vueuse/head";

const title = "Your Links in Disguise";

useHead({
    title: "FlooLink — Your Links in Disguise",
    meta: [
        {
            name: "description",
            content:
                "Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.",
        },
        {
            name: "keywords",
            content:
                "AES 256 encryption link generator, Encrypted URL sharing, Secure link encryption app, Decrypt protected links online, URL encryption and decryption tool, Privacy-focused link sharing, Secure URL generator with encryption, Temporary secure link generator, Expiring encrypted link sharing, Share URLs securely online, Encrypted links with expiration, Set link expiration for secure sharing, Time-sensitive encrypted links, Self-destructing encrypted links, Privacy-conscious file sharing, Secure data sharing for professionals, Encrypted link sharing for businesses, Built with VILT stack (Vue.js, Inertia.js, Laravel, Tailwind CSS), Advanced encryption link tool, Latest secure link sharing app.",
        },
        { name: "robots", content: "index, follow" },

        {
            property: "og:title",
            content: "FlooLink — Your Links in Disguise",
        },
        {
            property: "og:description",
            content:
                "Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.",
        },
        { property: "og:type", content: "website" },
        { property: "og:url", content: "https://floo.link" },
        {
            property: "og:image",
            content: "http://floo.link/images/floolink.jpg",
        },
        { property: "og:image:width", content: "1200" },
        { property: "og:image:height", content: "630" },

        { name: "twitter:card", content: "summary_large_image" },
        {
            name: "twitter:title",
            content: "FlooLink — Your Links in Disguise",
        },
        {
            name: "twitter:description",
            content:
                "Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.",
        },
        {
            name: "twitter:image",
            content: "http://floo.link/images/floolink.jpg",
        },

        { name: "author", content: "FlooLink — Your Links in Disguise" },
        { name: "theme-color", content: "#111827" },
    ],
    link: [{ rel: "canonical", href: "https://floo.link" }],
});
</script>

<template>
    <Head :title="title"/>

    <Tyndall streak-color="#fff" class="flex flex-col text-center scrollbar">
        <Particles
            :density="500"
            class="absolute inset-x-0 bottom-0 h-full w-full [mask-image:radial-gradient(100%_100%,white,transparent_80%)]"
        />
        <div
            class="flex flex-col items-center justify-start gap-16 pb-6 min-h-screen bg-gradient-to-br from-gray-950 to-gray-800 text-indigo-50">

            <div class="flex flex-col items-center justify-center mt-16 fill-indigo-50 motion-preset-focus motion-duration-2000 z-10">
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
            </div>

           <div class="flex flex-col items-center gap-4">
               <div class="flex items-center justify-center gap-2 w-full">
                   <LinkInput
                       label="Paste your link to encrypt or decrypt"
                       id="link"
                       type="url"
                       :required="true"
                       :autofocus="true"
                   />

                   <GenerativeButton class="flex items-center gap-2">
                       <PhSparkle width="20" weight="fill" class="-ml-2"/>
                       Make Magic
                   </GenerativeButton>
               </div>

               <div class="text-md font-regular w-8/12">
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

                <div class="flex flex-col gap-4 md:grid md:grid-cols-2 md:grid-rows-2">
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

                <div class="flex flex-col md:flex-row items-center gap-4">
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
