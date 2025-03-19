<script setup lang="ts">
import {computed, CSSProperties, reactive, ref} from "vue";

const props = withDefaults(
    defineProps<{
        class?: string;
        linkClass?: string;
        width?: number;
        height?: number;
        isStatic?: boolean;
        imageSrc?: string;
        url?: string;
    }>(),
    {
        isStatic: false,
        imageSrc: "",
        url: "#",
        width: 200,
        height: 125,
    }
);

const isVisible = ref(false);
const isLoading = ref(true);
const preview = ref<HTMLElement | null>(null);
const hasPopped = ref(false);

const previewSrc = computed(() => {
    if (props.isStatic) return props.imageSrc;

    const params = new URLSearchParams({
        url: props.url || "",
        screenshot: "true",
        meta: "false",
        embed: "screenshot.url",
        colorScheme: "light",
        "viewport.isMobile": "true",
        "viewport.deviceScaleFactor": "1",
        "viewport.width": String((props.width || 200) * 3),
        "viewport.height": String((props.height || 125) * 3),
    });

    return `https://api.microlink.io/?${params.toString()}`;
});

const mousePosition = reactive({
    x: 0,
    y: 0,
});

const previewStyle = computed<CSSProperties>(() => {
    if (!preview.value) return {};

    const offset = 20;
    const previewWidth = props.width || 200;
    const previewHeight = props.height || 125;
    const viewportWidth = window.innerWidth;

    let x = mousePosition.x - previewWidth / 2;
    x = Math.min(Math.max(0, x), viewportWidth - previewWidth);

    const linkRect = preview.value.parentElement?.getBoundingClientRect();
    const y = linkRect ? linkRect.top - previewHeight - offset : 0;

    return {
        position: "fixed",
        left: `${x}px`,
        top: `${y}px`,
        width: `${previewWidth}px`,
        height: `${previewHeight}px`,
    };
});

const imageStyle = computed<CSSProperties>(() => ({
    width: `${props.width}px`,
    height: `${props.height}px`,
}));

const popClass = computed(() => {
    if (!hasPopped.value) return "";
    return "animate-pop";
});

function handleMouseMove(event: MouseEvent) {
    mousePosition.x = event.clientX;
    mousePosition.y = event.clientY;
}

function showPreview() {
    isVisible.value = true;
    setTimeout(() => {
        hasPopped.value = true;
    }, 50);
}

function hidePreview() {
    isVisible.value = false;
    hasPopped.value = false;
}

function handleImageLoad() {
    isLoading.value = false;
}
</script>

<template>
    <div :class="['relative inline-block', props.class]">
        <a
            :href="url"
            target="_blank"
            rel="noopener noreferrer"
            :class="['font-semibold bg-linear-to-b from-indigo-400 to-indigo-600 bg-clip-text text-transparent hover:text-white transition ease-in-out', props.linkClass]"
            @mousemove="handleMouseMove"
            @mouseenter="showPreview"
            @mouseleave="hidePreview"
        >
            <slot />
        </a>


        <div
            v-if="isVisible"
            ref="preview"
            class="pointer-events-none absolute z-50"
            :style="previewStyle"
        >
            <div
                class="overflow-hidden rounded-xl shadow-xl"
                :class="[popClass, { 'transform-gpu': !props.isStatic }]"
            >
                <div
                    class="block rounded-xl border-2 border-transparent p-1 shadow-lg bg-gray-900"
                >
                    <img
                        :src="previewSrc"
                        :width="width"
                        :height="height"
                        class="size-full rounded-lg object-cover"
                        :style="imageStyle"
                        alt="preview"
                        @load="handleImageLoad"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.transform-gpu {
    transform-origin: center bottom;
    will-change: transform;
    backface-visibility: hidden;
}

.animate-pop {
    animation: pop 1000ms ease forwards;
    will-change: transform;
}

@keyframes pop {
    0% {
        transform: scale3d(0.26, 0.26, 1);
    }
    25% {
        transform: scale3d(1.1, 1.1, 1);
    }
    65% {
        transform: scale3d(0.98, 0.98, 1);
    }
    100% {
        transform: scale3d(1, 1, 1);
    }
}
</style>
