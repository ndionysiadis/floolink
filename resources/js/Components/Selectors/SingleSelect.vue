<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        modelValue?: string | null;
        label: string;
        error?: string | null | undefined;
        id: string;
        options: { value: string; label: string }[];
        required?: boolean;
        disabled?: boolean;
    }>(),
    {
        label: "",
        required: false,
        disabled: false,
    },
);

const emit = defineEmits(["update:modelValue"]);

function updateValue(event: Event) {
    const select = event.target as HTMLSelectElement;
    emit("update:modelValue", select.value);
}
</script>

<template>
    <div
        class="relative block border rounded-lg border-gray-50/10 w-full max-w-3xl bg-gray-900 text-indigo-50 shadow-xs focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500"
    >
        <label :for="props.id" class="sr-only">{{ props.label }}</label>

        <select
            :id="props.id"
            :required="props.required"
            :disabled="props.disabled"
            :value="props.modelValue"
            @change="updateValue"
            class="peer block w-full border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-hidden focus:ring-0"
        >
            <option value="" disabled selected class="text-gray-400">
                {{ props.label }}
            </option>
            <option
                v-for="option in props.options"
                :key="option.value"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>

        <span v-if="!props.error"
              class="pointer-events-none absolute rounded-md start-2.5 top-0 -translate-y-1/2 bg-gray-900 px-2 py-0.5 text-xs text-gray-400 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
        >
            {{ props.label }}
        </span>

        <span v-else
              class="pointer-events-none absolute rounded-md start-2.5 top-0 -translate-y-1/2 bg-gray-900 px-2 py-0.5 text-xs text-red-400 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
        >
            {{ props.error }}
        </span>
    </div>
</template>

<style scoped>

</style>
