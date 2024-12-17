<script setup lang="ts">
import { createNoise3D } from "simplex-noise";
import { onMounted, onUnmounted, useTemplateRef } from "vue";

// Constants
const TAU = 2 * Math.PI;
const baseTTL = 50;
const rangeTTL = 150;
const particlePropCount = 9;
const rangeHue = 100;
const noiseSteps = 3;
const xOff = 0.00125;
const yOff = 0.00125;
const zOff = 0.0005;

let tick = 0;

// Props (Inline Definition)
const props = withDefaults(
    defineProps<{
        class?: string;
        containerClass?: string;
        particleCount?: number;
        rangeY?: number;
        baseHue?: number;
        baseSpeed?: number;
        rangeSpeed?: number;
        baseRadius?: number;
        rangeRadius?: number;
        backgroundColor?: string;
    }>(),
    {
        particleCount: 700,
        rangeY: 100,
        baseSpeed: 0.0,
        rangeSpeed: 1.5,
        baseRadius: 1,
        rangeRadius: 2,
        baseHue: 220,
        backgroundColor: "#000000",
    },
);

// Refs
const canvasRef = useTemplateRef<HTMLCanvasElement | null>("canvasRef");
const containerRef = useTemplateRef<HTMLElement | null>("containerRef");

// Variables
const particlePropsLength = props.particleCount * particlePropCount;
const noise3D = createNoise3D();
let particleProps = new Float32Array(particlePropsLength);
let center: [number, number] = [0, 0];

// Utility Functions
const rand = (n: number) => n * Math.random();
const randRange = (n: number) => n - rand(2 * n);
const fadeInOut = (t: number, m: number) => {
    const halfM = 0.5 * m;
    return Math.abs(((t + halfM) % m) - halfM) / halfM;
};
const lerp = (n1: number, n2: number, speed: number) => (1 - speed) * n1 + speed * n2;

// Initialization
function setup() {
    const canvas = canvasRef.value;
    const container = containerRef.value;

    if (canvas && container) {
        const ctx = canvas.getContext("2d");
        if (ctx) {
            resize(canvas, ctx);
            initParticles();
            draw(canvas, ctx);
        }
    }
}

function initParticles() {
    tick = 0;
    particleProps = new Float32Array(particlePropsLength);
    for (let i = 0; i < particlePropsLength; i += particlePropCount) {
        initParticle(i);
    }
}

function initParticle(index: number) {
    const canvas = canvasRef.value;
    if (!canvas) return;

    const x = rand(canvas.width);
    const y = center[1] + randRange(props.rangeY);
    const vx = 0;
    const vy = 0;
    const life = 0;
    const ttl = baseTTL + rand(rangeTTL);
    const speed = props.baseSpeed + rand(props.rangeSpeed);
    const radius = props.baseRadius + rand(props.rangeRadius);
    const hue = props.baseHue + rand(rangeHue);

    particleProps.set([x, y, vx, vy, life, ttl, speed, radius, hue], index);
}

// Particle Drawing
function draw(canvas: HTMLCanvasElement, ctx: CanvasRenderingContext2D) {
    tick++;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = props.backgroundColor;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    drawParticles(ctx);
    renderGlow(canvas, ctx);
    renderToScreen(canvas, ctx);

    requestAnimationFrame(() => draw(canvas, ctx));
}

function drawParticles(ctx: CanvasRenderingContext2D) {
    for (let i = 0; i < particlePropsLength; i += particlePropCount) {
        updateParticle(i, ctx);
    }
}

function updateParticle(index: number, ctx: CanvasRenderingContext2D) {
    const canvas = canvasRef.value;
    if (!canvas) return;

    const [x, y, vx, vy, life, ttl, speed, radius, hue] = particleProps.slice(index, index + particlePropCount);

    const n = noise3D(x * xOff, y * yOff, tick * zOff) * noiseSteps * TAU;
    const nextVx = lerp(vx, Math.cos(n), 0.5);
    const nextVy = lerp(vy, Math.sin(n), 0.5);

    drawParticle(x, y, x + nextVx * speed, y + nextVy * speed, life, ttl, radius, hue, ctx);

    particleProps[index] = x + nextVx * speed;
    particleProps[index + 1] = y + nextVy * speed;
    particleProps[index + 2] = nextVx;
    particleProps[index + 3] = nextVy;
    particleProps[index + 4] = life + 1;

    if (checkBounds(x, y, canvas) || life > ttl) {
        initParticle(index);
    }
}

function drawParticle(
    x: number,
    y: number,
    x2: number,
    y2: number,
    life: number,
    ttl: number,
    radius: number,
    hue: number,
    ctx: CanvasRenderingContext2D,
) {
    ctx.save();
    ctx.lineCap = "round";
    ctx.lineWidth = radius;

    const isWhite = props.baseHue === -1;
    ctx.strokeStyle = isWhite
        ? `hsla(0, 0%, 100%, ${fadeInOut(life, ttl)})`
        : `hsla(${hue}, 100%, 60%, ${fadeInOut(life, ttl)})`;

    ctx.beginPath();
    ctx.moveTo(x, y);
    ctx.lineTo(x2, y2);
    ctx.stroke();
    ctx.closePath();
    ctx.restore();
}

// Utility Functions
const checkBounds = (x: number, y: number, canvas: HTMLCanvasElement) => x > canvas.width || x < 0 || y > canvas.height || y < 0;

function resize(canvas: HTMLCanvasElement, ctx?: CanvasRenderingContext2D) {
    const { innerWidth, innerHeight } = window;
    canvas.width = innerWidth;
    canvas.height = innerHeight;
    center = [0.5 * canvas.width, 0.5 * canvas.height];
}

// Glow Effects
function renderGlow(canvas: HTMLCanvasElement, ctx: CanvasRenderingContext2D) {
    ctx.save();
    ctx.filter = "blur(8px) brightness(200%)";
    ctx.globalCompositeOperation = "lighter";
    ctx.drawImage(canvas, 0, 0);
    ctx.restore();

    ctx.save();
    ctx.filter = "blur(4px) brightness(200%)";
    ctx.globalCompositeOperation = "lighter";
    ctx.drawImage(canvas, 0, 0);
    ctx.restore();
}

function renderToScreen(canvas: HTMLCanvasElement, ctx: CanvasRenderingContext2D) {
    ctx.save();
    ctx.globalCompositeOperation = "lighter";
    ctx.drawImage(canvas, 0, 0);
    ctx.restore();
}

// Lifecycle Hooks
onMounted(() => {
    setup();
    window.addEventListener("resize", () => {
        const canvas = canvasRef.value;
        const ctx = canvas?.getContext("2d");
        if (canvas && ctx) {
            resize(canvas, ctx);
        }
    });
});

onUnmounted(() => {
    window.removeEventListener("resize", () => {});
});
</script>

<template>
    <div :class="[props.containerClass, 'relative h-full w-full']">
        <div
            ref="containerRef"
            v-motion
            :initial="{ opacity: 0 }"
            :enter="{ opacity: 1 }"
            class="absolute inset-0 z-0 flex items-center justify-center bg-transparent"
        >
            <canvas ref="canvasRef"></canvas>
        </div>

        <div :class="[props.class, 'relative z-10']">
            <slot />
        </div>
    </div>
</template>
