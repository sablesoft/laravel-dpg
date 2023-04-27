<script setup>
import { guide } from "@/guide";
import { uuid } from 'vue-uuid';
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
    return guide.getRelation('post', 'topic', props.link.targetPostId).name;
}

let getNoteLink = function() {
    return guide.getRelation('note', 'topic', props.link.targetNoteId).name;
}
let getLinkName = function() {
    let link = guide.getLink(props.link.targetLinkId);
    let categoryName = guide.getField('topic', 'name', link.targetCategoryId);
    categoryName = categoryName ? categoryName : 'Info';
    let postName = guide.getRelation('post', 'topic', link.targetPostId).name;
    let noteTopic = guide.getRelation('note', 'topic', link.targetNoteId);
    let noteName = noteTopic ? noteTopic.name : null;
    return link.number + ': ' + categoryName + ' - ' + postName + (noteName ? ' - ' + noteName : '');
}
let getModuleName = function() {
    let module = guide.getRelation('post', 'module', props.link.targetPostId);
    return module ? module.name : null;
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
    <p :id="'link' + (link.id ? link.id : uuid.v1())"
       data-entity="link" :data-id="link.id"
       :class="link.id && guide.linksId === link.id ? 'active-block' : ''">
        <span v-if="link.number" class="link-number cursor-pointer" @click="guide.linksId = guide.linksId === link.id ? null : link.id">
            {{ link.number }}:
        </span>
        <template v-if="link.targetCategoryId">
            <span class="link-title" @click.prevent.stop="guide.goTo(link, 'category')">
                {{ getCategoryLink() }}
            </span>
        </template>
        <template v-else>
            <span>{{ __('Info') }}</span>
        </template>
        <template v-if="link.targetPostId">
            - <span class="link-title" @click.prevent.stop="guide.goTo(link, 'post')">
                {{ getPostLink() }}
            </span>
        </template>
        <template v-if="link.targetNoteId">
            - <span class="link-title" @click.prevent.stop="guide.goTo(link, 'note')">
                {{ getNoteLink() }}
            </span>
        </template>
        <template v-if="link.targetLinkId">
            - <span class="link-title" @click.prevent.stop="guide.goTo(link, 'link')">
                ( {{ getLinkName() }} )
            </span>
        </template>
        <template v-if="getModuleName()">
            <span>
                [ {{ __('Module') + ' "' + getModuleName() + '"' }} ]
            </span>
        </template>
    </p>
</template>
