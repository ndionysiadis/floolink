<script setup lang="ts">
import {UseMouseEventExtractor} from '@vueuse/core'
import { useMouse } from '@vueuse/core'
import {ref} from "vue";

withDefaults(
    defineProps<{
        color?: string
        size?: number
    }>(),
    {
        color: 'rgba(67, 56, 202, 0.2)',
        size: 200
    }
)

const spotlightCardRef = ref<HTMLElement | null>(null)
const extractor: UseMouseEventExtractor = (event) =>
    event instanceof Touch ? null : [event.offsetX, event.offsetY]
const { x, y } = useMouse({ target: spotlightCardRef, type: extractor })
</script>

<template>
    <div
        class="rounded-xl border border-gray-50/10 bg-gray-900/10 p-2"
        ref="spotlightCardRef"
    >
        <div
            :style="{
        '--x': `${x}px`,
        '--y': `${y}px`,
        '--spotlight-color-stops': `${color}, transparent`,
        '--spotlight-size': `${size}px`
      }"
            class="spotlight-card before:content-[''] before:h-full before:w-full before:absolute before:top-0 before:left-0 relative transform-gpu overflow-hidden rounded-lg border border-gray-50/10 bg-gray-950 shadow-sm shadow-neutral-950/50"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>
.spotlight-card:before {
    opacity: 0;
    transition: opacity 0.3s;
    background-image: radial-gradient(
        var(--spotlight-size) circle at var(--x) var(--y),
        var(--spotlight-color-stops)
    );
}
.spotlight-card:hover:before {
    opacity: 1;
    transition: opacity 0.3s;
}
</style>
