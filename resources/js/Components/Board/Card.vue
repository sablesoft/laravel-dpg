<script setup>
    const props = defineProps({
        card: { type: Object, required: true }
    });
</script>
<style scoped>
    .card {
        text-align: center;
    }
    .card-name {
        font-weight: bold;
    }
    .card-content {
        margin-top: 10px;
    }
    .card-image {
        height: 250px;
    }
    .card-image>img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .card-desc {
        height: 320px;
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
        white-space: pre-line;
    }
</style>
<template>
    <div class="card shadow-sm sm:rounded-lg">
        <div class="card-content card-name">
            {{ card.name }}
        </div>
        <div class="card-content card-image">
            <img :src="card.image" alt="">
        </div>
        <div class="card-content card-scope">
            {{ card.scope_name }}
        </div>
        <div class="card-content card-desc">
            {{ card.desc }}
        </div>
    </div>
</template>
