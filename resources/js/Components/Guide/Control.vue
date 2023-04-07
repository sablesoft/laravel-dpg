<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AddPost from '@/Components/Guide/AddPost.vue';
import AddNote from '@/Components/Guide/AddNote.vue';
import AddLink from '@/Components/Guide/AddLink.vue';

import { guide } from "@/guide";
import {isEmpty} from "lodash/lang";
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
    if (_entity() === 'post' && guide.isActive(guide.getNote())) {
        return false;
    }

    return true;
}
let showView = function() {
    return guide.tab === 'Project';
}
let showCreatePost = function() {
    return !guide.isAddPost &&
        _entity() === 'category';
}
let showAddNote = function() {
    return !guide.isAddNote &&
        (_entity() === 'project' || _entity() === 'post');
}
let showAddLink = function() {
    return !guide.isAddLink &&
        (_entity() === 'post' || _entity() === 'note');
}
let showDelete = function() {
    // noinspection RedundantIfStatementJS
    if (_entity() === 'category' && isEmpty(props.item.categoryPostIds)) {
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
                <SecondaryButton v-if="showCreatePost()" @click.prevent.stop="guide.isAddPost = true">
                    {{__('Add Post')}}
                </SecondaryButton>
                <SecondaryButton v-if="showAddNote()" @click.prevent.stop="guide.isAddNote = true">
                    {{__('Add Note')}}
                </SecondaryButton>
                <SecondaryButton v-if="showAddLink()" @click.prevent.stop="guide.isAddLink = true">
                    {{__('Add Link')}}
                </SecondaryButton>
                <SecondaryButton v-if="showDelete()" @click.prevent.stop="guide.delete(item, _entity())">
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
            <AddPost v-if="guide.isAddPost"/>
            <AddNote v-if="guide.isAddNote" :item="item"/>
            <AddLink v-if="guide.isAddLink" :item="item"/>
        </div>
        <hr/>
    </div>
</template>
