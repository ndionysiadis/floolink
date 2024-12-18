<script lang="ts" setup>
const props = defineProps<{
    shimmerWidth?: number;
}>();

const shimmerWidth = props.shimmerWidth ?? 100;
</script>

<template>
    <p
        :style="{ '--shimmer-width': `${shimmerWidth}px` }"
        :class="[
      'mx-auto max-w-md text-neutral-600/50 dark:text-neutral-400/50',
      'animate-shimmer bg-clip-text bg-no-repeat [background-position:0_0] [background-size:var(--shimmer-width)_100%] [transition:background-position_1s_cubic-bezier(.6,.6,0,1)_infinite]',
      'bg-gradient-to-r from-transparent via-black/80 via-50% to-transparent dark:via-white/80',
    ]"
    >
        <slot/>
    </p>
</template>
