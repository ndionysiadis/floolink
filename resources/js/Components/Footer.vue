<script setup lang="ts">
import moment from "moment";
import {PhHeart} from "@phosphor-icons/vue";
import ApplicationMark from "@/Components/Logos/ApplicationMark.vue";

const currentYear = moment().format("YYYY");
</script>

<template>
    <div class="flex flex-col items-center text-sm tracking-wide text-gray-300">
        <ApplicationMark class="w-20 fill-gray-300 mb-3"/>
        <div>&#169; {{ currentYear }} floolink. All rights reserved</div>
        <div class="flex items-center gap-1 text-xs text-gray-500">
            Crafted with
            <PhHeart weight="fill"/>
            by
            <span class="font-bold">@ndionysiadis</span>
        </div>
    </div>
</template>
