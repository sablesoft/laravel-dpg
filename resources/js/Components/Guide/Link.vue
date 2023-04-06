<script setup>
import { guide } from "@/guide";
const props = defineProps({
    link: {
        type: Object,
        required: true
    }
});
let getCategoryLink = function() {
    return guide.getTopic(props.link.targetCategoryId).name;
}

let getPostLink = function() {
    let post = guide.getPost(props.link.targetPostId);
    let topic = guide.getTopic(post.topicId);

    return topic.name;
}

let getNoteLink = function() {
    let note = guide.getNote(props.link.targetNoteId);
    let topic = guide.getTopic(note.topicId);

    return topic.name;
}
</script>
<style>
.link-number {
    font-weight: bold;
}
.link-title {
    text-decoration: underline;
    cursor: pointer;
}
</style>
<template>
    <p>
        <span class="link-number">{{link.number}}: </span>
        <span class="link-title" @click.prevent.stop="guide.goTo(link, 'category')">
            {{getCategoryLink()}}
        </span>
        - <span class="link-title" @click.prevent.stop="guide.goTo(link, 'post')">
            {{getPostLink()}}
        </span>
        <template v-if="link.targetNoteId">
            - <span class="link-title" @click.prevent.stop="guide.goTo(link, 'note')">
                {{getNoteLink()}}
            </span>
        </template>
    </p>
</template>
