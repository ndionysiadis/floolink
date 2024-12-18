<script setup lang="ts">
import { ref } from "vue";
import { useTimeoutFn } from "@vueuse/core";

const props = defineProps<{
    class?: string;
    width?: number;
    height?: number;
}>();

const isPointerInside = ref(false);
const refElement = ref<HTMLElement | null>(null);

const state = ref({
    glare: { x: 50, y: 50 },
    background: { x: 50, y: 50 },
    rotate: { x: 0, y: 0 },
});

function handlePointerMove(event: PointerEvent) {
    const rotateFactor = 0.4;
    const rect = refElement.value?.getBoundingClientRect();
    if (rect) {
        const position = {
            x: event.clientX - rect.left,
            y: event.clientY - rect.top,
        };
        const percentage = {
            x: (100 / rect.width) * position.x,
            y: (100 / rect.height) * position.y,
        };
        const delta = {
            x: percentage.x - 50,
            y: percentage.y - 50,
        };
        state.value.background.x = 50 + percentage.x / 4 - 12.5;
        state.value.background.y = 50 + percentage.y / 3 - 16.67;
        state.value.rotate.x = -(delta.x / 3.5) * rotateFactor;
        state.value.rotate.y = (delta.y / 2) * rotateFactor;
        state.value.glare.x = percentage.x;
        state.value.glare.y = percentage.y;
    }
}

function handlePointerEnter() {
    isPointerInside.value = true;
    useTimeoutFn(() => {
        if (isPointerInside.value && refElement.value) {
            refElement.value.style.setProperty("--duration", "0s");
        }
    }, 300);
}

function handlePointerLeave() {
    isPointerInside.value = false;
    if (refElement.value) {
        refElement.value.style.removeProperty("--duration");
        state.value.rotate = { x: 0, y: 0 };
    }
}
</script>

<template>
    <div
        ref="refElement"
        class="container-style rounded-xl border border-gray-50/10 bg-gray-900/10 backdrop-blur-sm p-2 duration-[var(--duration)] ease-[var(--easing)] delay-[var(--delay)] relative isolate transition-transform will-change-transform [aspect-ratio:17/21] [contain:layout_style] [perspective:600px]"
        :style="{ width: `${props.width || 320}px`, height: `${props.height || 400}px` }"
        @pointermove="handlePointerMove"
        @pointerenter="handlePointerEnter"
        @pointerleave="handlePointerLeave"
    >
        <div
            class="rounded-lg border border-gray-50/10 bg-gray-950/20 shadow-sm shadow-neutral-950/50 relative transform-gpu overflow-hidden w-full h-full"
        >
            <div
                class="duration-[var(--duration)] ease-[var(--easing)] delay-[var(--delay)] grid h-full origin-center overflow-hidden rounded-lg transition-transform will-change-transform [transform:rotateY(var(--r-x))_rotateX(var(--r-y))] hover:filter-none hover:[--duration:200ms] hover:[--easing:linear] hover:[--opacity:0.6]"
            >
                <div
                    class="grid size-full mix-blend-soft-light [clip-path:inset(0_0_0_0_round_var(--radius))] [grid-area:1/1]"
                >
                    <div :class="['size-full bg-gray-950', props.class]">
                        <slot />
                    </div>
                </div>
                <div
                    class="transition-background duration-[var(--duration)] ease-[var(--easing)] delay-[var(--delay)] will-change-background grid size-full opacity-[var(--opacity)] mix-blend-soft-light transition-opacity [background:radial-gradient(farthest-corner_circle_at_var(--m-x)_var(--m-y),_rgba(255,255,255,0.8)_10%,_rgba(255,255,255,0.65)_20%,_rgba(255,255,255,0)_90%)] [clip-path:inset(0_0_1px_0_round_var(--radius))] [grid-area:1/1]"
                />
                <div
                    class="background-style will-change-background after:grid-area-[inherit] after:bg-repeat-[inherit] after:bg-attachment-[inherit] after:bg-origin-[inherit] after:bg-clip-[inherit] relative grid size-full opacity-[var(--opacity)] mix-blend-color-dodge transition-opacity [background-blend-mode:hue_hue_hue_overlay] [background:var(--pattern),_var(--rainbow),_var(--diagonal),_var(--shade)] [clip-path:inset(0_0_1px_0_round_var(--radius))] [grid-area:1/1] after:bg-[inherit] after:mix-blend-exclusion after:content-[\'\'] after:[background-blend-mode:soft-light,_hue,_hard-light] after:[background-position:center,_0%_var(--bg-y),_calc(var(--bg-x)*_-1)_calc(var(--bg-y)*_-1),_var(--bg-x)_var(--bg-y)] after:[background-size:var(--foil-size),_200%_400%,_800%,_200%]"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.background-style {
    --step: 5%;
    --foil-svg: none;
    --pattern: none;
    --rainbow: repeating-linear-gradient(
        0deg,
        rgba(75, 0, 130, 0.8) calc(var(--step) * 1),
        rgba(128, 0, 128, 0.7) calc(var(--step) * 2),
        rgba(153, 50, 204, 0.6) calc(var(--step) * 3),
        rgba(186, 85, 211, 0.5) calc(var(--step) * 4),
        rgba(216, 191, 216, 0.4) calc(var(--step) * 5),
        rgba(128, 0, 128, 0.7) calc(var(--step) * 6),
        rgba(75, 0, 130, 0.8) calc(var(--step) * 7)
    )
    0% var(--bg-y) / 200% 700% no-repeat;
    --diagonal: repeating-linear-gradient(
        128deg,
        #4B0082 0%,
        hsl(270, 50%, 50%) 3.8%,
        hsl(270, 50%, 55%) 4.5%,
        hsl(270, 50%, 60%) 5.2%,
        #4B0082 10%,
        #4B0082 12%
    )
    var(--bg-x) var(--bg-y) / 300% no-repeat;
    --shade: radial-gradient(
        farthest-corner circle at var(--m-x) var(--m-y),
        rgba(255, 255, 255, 0.1) 12%,
        rgba(255, 255, 255, 0.15) 20%,
        rgba(255, 255, 255, 0.25) 120%
    )
    var(--bg-x) var(--bg-y) / 300% no-repeat;
    background-blend-mode: hue, hue, hue, overlay;
}
.container-style {
    --m-x: v-bind(state.glare.x + "%");
    --m-y: v-bind(state.glare.y + "%");
    --r-x: v-bind(state.rotate.x + "deg");
    --r-y: v-bind(state.rotate.y + "deg");
    --bg-x: v-bind(state.background.x + "%");
    --bg-y: v-bind(state.background.y + "%");
    --duration: 300ms;
    --foil-size: 100%;
    --opacity: 0;
    --radius: 10px;
    --easing: ease;
    --transition: var(--duration) var(--easing);
}
</style>
