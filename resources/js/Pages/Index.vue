<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/Logos/ApplicationLogo.vue";
import Tyndall from "@/Components/Effects/Tyndall.vue";
import Particles from "@/Components/Effects/Particles.vue";
import GeneratedText from "@/Components/Effects/GeneratedText.vue";
import TextLink from "@/Components/Texts/TextLink.vue";
import {PhDetective, PhHourglass, PhLockSimple, PhSparkle} from "@phosphor-icons/vue";
import LaravelLogo from "@/Components/Logos/LaravelLogo.vue";
import TailwindLogo from "@/Components/Logos/TailwindLogo.vue";
import InertiaLogo from "@/Components/Logos/InertiaLogo.vue";
import VueLogo from "@/Components/Logos/VueLogo.vue";
import GlareCard from "@/Components/Cards/GlareCard.vue";
import GlowCard from "@/Components/Cards/GlowCard.vue";
import Footer from "@/Components/Footer.vue";
import ShimmerText from "@/Components/Texts/ShimmerText.vue";
import FlooInput from "@/Components/Inputs/FlooInput.vue";
import GenerativeButton from "@/Components/Buttons/GenerativeButton.vue";
import {useHead} from "@vueuse/head";
import SingleSelect from "@/Components/Selectors/SingleSelect.vue";
import HyperText from "@/Components/Effects/HyperText.vue";
import SimpleCard from "@/Components/Cards/SimpleCard.vue";
import {computed} from "vue";

const title = "Your Links in Disguise";

const form = useForm({
    original_url: "",
    expiration_type: "default",
    customMinutes: null,
});

const props = defineProps<{
    generatedLink?: string
}>();

const generatedLink = computed(() => props.generatedLink || '');

const expirationOptions = [
    { value: "default", label: "Default (When clicked)" },
    { value: "never", label: "Never Expire" },
    { value: "5", label: "5 Minutes" },
    { value: "60", label: "1 Hour" },
    { value: "1440", label: "24 Hours" },
    { value: "10080", label: "7 Days" },
    { value: "custom", label: "Custom" },
]

const submitForm = () => {
    form.post(route("links.store"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            form.clearErrors();
            form.original_url = '';
            form.expiration_type = 'default';
            form.customMinutes = null;
        },
    });
};

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
        {name: "robots", content: "index, follow"},

        {
            property: "og:title",
            content: "FlooLink — Your Links in Disguise",
        },
        {
            property: "og:description",
            content:
                "Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.",
        },
        {property: "og:type", content: "website"},
        {property: "og:url", content: "https://floo.link"},
        {
            property: "og:image",
            content: "https://floo.link/images/floolink.jpg",
        },
        {property: "og:image:width", content: "1200"},
        {property: "og:image:height", content: "630"},

        {name: "twitter:card", content: "summary_large_image"},
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

        {name: "author", content: "FlooLink — Your Links in Disguise"},
        {name: "theme-color", content: "#111827"},
    ],
    link: [{rel: "canonical", href: "https://floo.link"}],
});
</script>

<template>
    <Head :title="title"/>

    <Tyndall streak-color="#fff" class="flex flex-col text-center min-h-screen bg-linear-to-br from-gray-950 to-gray-800 text-indigo-50">
        <Particles
            :density="500"
            class="absolute inset-x-0 bottom-0 h-full w-full [mask-image:radial-gradient(100%_100%,white,transparent_80%)]"
        />
        <div
            class="flex flex-col items-center justify-start gap-16 grow">

            <div
                class="flex flex-col items-center justify-center mt-16 fill-indigo-50 motion-preset-focus motion-duration-2000 z-10">
                <ApplicationLogo class="w-40 lg:w-56"/>
            </div>

            <div class="flex flex-col items-center gap-4 px-4 lg:px-0 lg:w-7/12">
                <div
                    class="rounded-full px-4 py-1 border border-gray-50/10 bg-gray-950"
                >
                    <ShimmerText class="text-sm lg:text-md">
                        Generate Encrypted Links
                    </ShimmerText>
                </div>

                <GeneratedText
                    words="Teleport your links securely through the magic of Floo network"
                    class="text-2xl lg:text-4xl font-bold font-title"
                />


                <form @submit.prevent="submitForm" class="flex flex-col items-center justify-center gap-4 w-full">
                    <FlooInput
                        label="Paste your link to encrypt"
                        id="link"
                        type="url"
                        v-model="form.original_url"
                        :required="true"
                        :autofocus="true"
                        :error="form.errors.original_url"
                    />

                    <div v-if="form.original_url.length > 0"
                         class="flex items-center justify-center motion-preset-focus motion-duration-500 w-full">
                        <SingleSelect
                            id="expiration-time"
                            label="Set expiration time"
                            :options="expirationOptions"
                            v-model="form.expiration_type"
                            :error="form.errors.expiration_type"
                        />
                    </div>

                    <div v-if="form.expiration_type === 'custom'"
                         class="flex items-center justify-center w-full motion-preset-focus motion-duration-500">
                        <FlooInput
                            id="custom_time"
                            label="Enter minutes"
                            type="number"
                            v-model="form.customMinutes"
                            min="1"
                            max="525600"
                            :autofocus="false"
                            :error="form.errors.customMinutes"
                        />
                    </div>

                    <GenerativeButton
                        v-if="form.original_url.length > 0"
                        :disabled="form.processing"
                        class="flex items-center gap-2 motion-preset-pop motion-duration-500"
                        @click="submitForm"
                    >
                        <PhSparkle width="20" weight="fill" class="-ml-2"/>
                        Make Magic
                    </GenerativeButton>
                </form>

                <div v-if="generatedLink" class="motion-preset-focus motion-duration-500 flex flex-col w-full items-center gap-2 text-left">
                    <SimpleCard>
                        <div class="p-4">
                            <div class="flex items-center gap-2">
                                <PhDetective :size="32" color="#4338CA" weight="duotone" />
                                <div class="font-semibold font-title text-lg">
                                    <HyperText :text="generatedLink" />
                                </div>
                            </div>
                            <div>
                                This is your FlooLink. Visitors can access it directly. Share it.
                            </div>
                        </div>
                    </SimpleCard>
                </div>
            </div>

            <div class="flex flex-col items-center lg:grid lg:grid-cols-12 gap-16 lg:gap-4 px-4 lg:px-0 max-w-3xl">
                <div class="flex flex-col gap-4 col-span-5">
                    <div class="text-xl lg:text-2xl font-bold font-title">
                        Why FlooLink
                    </div>
                    <div class="text-sm lg:text-md font-regular lg:text-left">
                        Inspired by the
                        <TextLink url="https://harrypotter.fandom.com/wiki/Floo_Network">magical
                            fireplaces
                        </TextLink>
                        in Harry Potter that transport wizards safely, Floolink teleports your URLs using advanced
                        <TextLink url="https://en.wikipedia.org/wiki/Advanced_Encryption_Standard">AES-256 encryption
                        </TextLink>
                        ,
                        transforming them into protected links ready to share. Make your links disappear from
                        prying eyes and reappear exactly where you need them – safe, secure, and magical. <span
                        class="font-bold">Expired links are
                    automatically deleted within an hour, ensuring your data remains private and protected.</span>
                    </div>
                </div>

                <div class="flex flex-col gap-4 col-span-7">
                    <div class="text-xl lg:text-2xl font-bold font-title">
                        The spells
                    </div>
                    <div class="flex flex-col md:flex-row lg:flex-col gap-4">
                        <GlowCard>
                            <div class="p-2 lg:p-4 text-left">
                                <div class="flex items-center gap-2">
                                    <PhLockSimple :size="28" color="#4338CA" weight="duotone"/>
                                    <div class="font-semibold font-title text-sm lg:text-md">Protego Linkium</div>
                                </div>
                                <div class="text-xs lg:text-sm">
                                    Paste, encrypt, and send your links safely.
                                </div>
                            </div>
                        </GlowCard>
                        <GlowCard>
                            <div class="p-2 lg:p-4 text-left">
                                <div class="flex items-center gap-2">
                                    <PhHourglass :size="28" color="#4338CA" weight="duotone"/>
                                    <div class="font-semibold font-title text-sm lg:text-md">Evanesco Tempus</div>
                                </div>
                                <div class="text-xs lg:text-sm">
                                    Links that vanish when you want. Magic!
                                </div>
                            </div>
                        </GlowCard>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-4">
                <div class="text-xl lg:text-2xl font-bold font-title">
                    Built with all the modern technologies
                </div>

                <div class="flex flex-col md:grid md:grid-cols-2 md:grid-rows-2 lg:grid lg:grid-cols-4 lg:grid-rows-1 gap-4">
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
        </div>

        <div class="mb-4">
            <Footer/>
        </div>
    </Tyndall>
</template>

<style scoped>

</style>
