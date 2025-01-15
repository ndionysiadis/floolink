<script setup lang="ts">
import { ref, computed, watch } from "vue";
import { useIntervalFn } from "@vueuse/core";

const props = withDefaults(
    defineProps<{
        text: any;
        duration?: number;
        class?: string;
        animateOnLoad?: boolean;
    }>(),
    {
        duration: 1200,
        class: "",
        animateOnLoad: true,
    }
);

const alphabets = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const displayText = ref<string[]>(props.text.split(""));
const iterations = ref(0);

function getRandomLetter(): string {
    return alphabets[Math.floor(Math.random() * alphabets.length)];
}

function triggerAnimation() {
    iterations.value = 0;
    startAnimation();
}

const { pause, resume } = useIntervalFn(
    () => {
        if (iterations.value < props.text.length) {
            displayText.value = displayText.value.map((l: string, i: number) =>
                l === " " ? l : i <= iterations.value ? props.text[i] : getRandomLetter()
            );
            iterations.value += 0.1;
        } else {
            pause();
        }
    },
    computed(() => props.duration! / (props.text.length * 10)) // Add non-null assertion for optional prop
);

function startAnimation() {
    pause();
    resume();
}

watch(
    () => props.text,
    (newText: string) => {
        displayText.value = newText.split("");
        triggerAnimation();
    }
);

if (props.animateOnLoad) {
    triggerAnimation();
}
</script>

<template>
    <div class="flex overflow-hidden">
        <div>
            <span
                v-for="(letter, i) in displayText"
                :key="i"
                v-motion
                :class="[
                    letter === ' ' ? 'w-3' : '',
                    props.class
                ]"
                class="inline-block"
                :initial="{ opacity: 0, y: -10 }"
                :enter="{ opacity: 1, y: 0 }"
                :delay="i * (props.duration! / (props.text.length * 10))"
            >
            {{ letter }}
            </span>
        </div>
    </div>
</template>
