<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AddPost from '@/Components/Guide/AddPost.vue';
import AddNote from '@/Components/Guide/AddNote.vue';
import AddLink from '@/Components/Guide/AddLink.vue';
import AddTag from '@/Components/Guide/AddTag.vue';

import { guide } from "@/guide";
import { isEmpty } from "lodash/lang";
const props = defineProps({
    item: {
        type: Object,
        required: true
    },
    entity: {
        type: String,
        required: false
    }
});
let isActive = function() {
    if (!guide.isActive(props.item, _entity())) {
        return false;
    }
    if (_entity() === 'category' && guide.isActive(guide.getPost())) {
        return false;
    }
    if (_entity() === 'project' && guide.isActive(guide.getNote())) {
        return false;
    }
    if (_entity() === 'post' && guide.isActive(guide.getNote())) {
        return false;
    }

    return true;
}
let showView = function() {
    return guide.tab === 'ProjectInfo' && !guide.notesId && !guide.postsId;
}
let showSort = function() {
    return guide.tab !== 'Buffer' && !guide.draggable;
}
let showTags = function() {
    return guide.postsId;
}
let showCreatePost = function() {
    return !guide.postAdding &&
        _entity() === 'category';
}
let showAddNote = function() {
    return guide.tab !== 'ProjectInfo' && !guide.noteAdding &&
        (['project', 'post', 'module'].includes(_entity()));
}
let showAddLink = function() {
    return !guide.linkAdding && guide.tab !== 'ProjectInfo' &&
        (_entity() === 'post' || _entity() === 'note');
}
let showCopy = function() {
    if (_entity() === 'buffer' && !guide.getItem('buffer').text) {
        return false;
    }
    return ['category', 'post', 'note', 'buffer'].includes(_entity());
}
let showDownload = function() {
    return _entity() === 'buffer' && guide.getItem('buffer').text;
}
let showBuffer = function() {
    return ['category', 'post', 'note'].includes(_entity());
}
let showDelete = function() {
    if (_entity() === 'category' && isEmpty(props.item.categoryPostIds)) {
        return false;
    }
    if (_entity() === 'buffer' && !guide.getItem('buffer').text) {
        return false;
    }
    // noinspection RedundantIfStatementJS
    if (_entity() === 'project' && route().current() === 'guide.project') {
        return false;
    }

    return true;
}
let view = function() {
    window.location.href = '/' + _entity() + '/' + guide[_entity() + 'sId'];
}
let _entity = function() {
    return props.entity ? props.entity : props.item.entity;
}
</script>

<style>
</style>

<template>
    <div v-if="isActive()" class="block-control mb-2 mt-2">
        <hr/>
        <div v-if="!guide.isAdding()" class="control">
            <div class="float-left pt-2">
                <SecondaryButton v-if="showView()" @click.prevent.stop="view()">
                    {{ __('View')}}
                </SecondaryButton>
                <SecondaryButton v-if="showSort()" @click.prevent.stop="guide.draggable = true">
                    {{ __('Sort')}}
                </SecondaryButton>
                <SecondaryButton v-if="showAddLink()" @click.prevent.stop="guide.linkAdding = true">
                    {{__('Add Link')}}
                </SecondaryButton>
                <SecondaryButton v-if="showTags()" @click.prevent.stop="guide.tagAdding = true">
                    {{ __('Tags')}}
                </SecondaryButton>
                <SecondaryButton v-if="showCreatePost()" @click.prevent.stop="guide.postAdding = true">
                    {{__('Add Post')}}
                </SecondaryButton>
                <SecondaryButton v-if="showAddNote()" @click.prevent.stop="guide.noteAdding = true">
                    {{__('Add Note')}}
                </SecondaryButton>
                <SecondaryButton v-if="showCopy()" @click.prevent.stop="guide.copy(item, _entity())">
                    {{__('Copy')}}
                </SecondaryButton>
                <SecondaryButton v-if="showDownload()" @click.prevent.stop="guide.downloadBuffer()">
                    {{__('Download')}}
                </SecondaryButton>
                <SecondaryButton v-if="showBuffer()" @click.prevent.stop="guide.addToBuffer(item, _entity())">
                    {{__('Buffer')}}
                </SecondaryButton>
                <SecondaryButton v-if="showDelete()" @click.prevent.stop="guide.askDeletion(item, _entity())">
                    {{__('Delete')}}
                </SecondaryButton>
                <SecondaryButton v-if="guide.backLink" @click="guide.goBack()">
                    {{__('Go Back')}}
                </SecondaryButton>
            </div>
            <div class="float-right">
                <div>
                    <span class="note-mark">{{ __('Created At')}}: </span>
                    <span> {{ item.createdAt }}</span>
                </div>
                <div>
                    <span class="note-mark">{{ __('Updated At')}}: </span>
                    <span> {{ item.updatedAt }}</span>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="forms">
            <AddPost v-if="guide.postAdding"/>
            <AddNote v-if="guide.noteAdding" :item="item"/>
            <AddLink v-if="guide.linkAdding" :item="item"/>
            <AddTag v-if="guide.tagAdding" :item="item"/>
        </div>
        <hr/>
    </div>
</template>
