<script setup>
import Editable from '@/Components/Editable.vue';
import Link from '@/Components/Guide/Link.vue';
import AddTopic from '@/Components/Guide/AddTopic.vue';
import Control from '@/Components/Guide/Control.vue';
import { guide } from "@/guide";
import { isEmpty } from "lodash/lang";
let linkToCategory = function() {
    return {
        id : null,
        entity : 'link',
        number : null,
        targetCategoryId : guide.topicsId,
        targetPostId : null,
        targetNoteId : null
    };
}
let linksToPosts = function() {
    let number = 1;
    let links = [];
    let posts = guide.getRelations('topic', 'post', null, true);
    posts.forEach(function(post) {
        links.push({
            id : null,
            entity : 'link',
            number : number++,
            targetCategoryId : post.categoryId,
            targetPostId : post.id,
            targetNoteId : null
        });
    });

    return links;
}
let linksToNotes = function() {
    let number = 1;
    let links = [];
    let notes = guide.getRelations('topic', 'note', null, true);
    notes.forEach(function(note) {
        links.push({
            id : null,
            entity : 'link',
            number : number++,
            targetCategoryId : note.postId ? guide.getPost(note.postId).categoryId : null,
            targetPostId : note.postId ? note.postId : null,
            targetNoteId : note.id
        });
    });

    return links;
}
let linksToLinks = function() {
    let number = 1;
    let links = [];
    guide.getTopic().categoryLinkIds.forEach(function(id) {
        links.push(_linkToLink(id, number++));
    });
    let posts = guide.getRelations('topic', 'post', null, true);
    posts.forEach(function(post) {
        post.targetLinkIds.forEach(function(id) {
            links.push(_linkToLink(id, number++));
        });
    });
    let notes = guide.getRelations('topic', 'note', null, true);
    notes.forEach(function(note) {
        note.targetLinkIds.forEach(function(id) {
            links.push(_linkToLink(id, number++));
        });
    });

    return links;
}
let _linkToLink = function(id, number) {
    let link = guide.getLink(id);
    let post = link.postId ? guide.getItem('post', link.postId) :
        guide.getRelation('note', 'post', link.noteId);
    let categoryId = post ? post.categoryId : null;

    return {
        id : null,
        number : number,
        entity : 'link',
        targetCategoryId : categoryId,
        targetPostId : post ? post.id : null,
        targetNoteId : link.noteId,
        targetLinkId : id
    }
}
let updateModule = function(value) {
    guide.updateField('topic', 'project_id', null);
    guide.updateField('topic', 'module_id', value);
}
let updateProject = function(value) {
    guide.updateField('topic', 'module_id', null);
    guide.updateField('topic', 'project_id', value);
}
</script>
<style>
.note-mark {
    font-weight: bold;
}
.note-row {
    margin-bottom: 8px;
}
button {
    background-color: #fff;
    border-color: #6b7280;
    border-width: 1px;
    border-radius: 0;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5rem;
    --tw-shadow: 0 0 #0000;
    margin-left: 6px;
}
</style>
<template>
    <!-- Add Topic -->
    <div v-if="!guide.topicsId && guide.topicAdding" class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <AddTopic/>
    </div>
    <!-- Topic Info -->
    <div v-if="guide.topicsId && !guide.topicAdding" :id="'topic' + guide.topicsId"
         class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p class="note-row">
                    <span class="note-mark inline">{{ __('Name') }}: </span>
                    <Editable :value="guide.getTopicField('name')" type="input" class="inline"
                              @updated="(value) => guide.updateField('topic', 'name', value)"/>
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Project') }}: </span>
                    <Editable :value="guide.getTopicProject() ? guide.getTopicProject().id : null"
                              class="inline" type="select" :items="guide.projects"
                              placeholder="Global" placeholder-enabled="1"
                              @updated="(value) => updateProject(value)"/>
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Module') }}: </span>
                    <Editable :value="guide.getTopicField('module_id')"
                              class="inline" type="select" :items="guide.getProjectModules()"
                              placeholder="Select Module" placeholder-enabled="1"
                              @updated="(value) => updateModule(value)"/>
                </p>
                <Control :item="guide.getTopic()"/>
                <p class="note-row">
                    <span class="note-mark">{{ __('Desc') }}</span>
                    <Editable :value="guide.getTopicField('text')"
                              @updated="(value) => guide.updateField('topic', 'text', value)"/>
                </p>
                <div v-if="guide.isCategory()" class="note-row">
                    <hr><br>
                    <span class="note-mark">{{ __('Category') }}: </span>
                    <Link :link="linkToCategory()" class="inline"/>
                </div>
                <div v-if="!isEmpty(linksToPosts())" class="note-row">
                    <hr><br>
                    <span class="note-mark">{{ __('Posts') }}</span>
                    <hr>
                    <Link v-for="link in linksToPosts()" :link="link"/>
                </div>
                <div v-if="!isEmpty(linksToNotes())" class="note-row">
                    <hr><br>
                    <span class="note-mark">{{ __('Notes') }}</span>
                    <hr>
                    <Link v-for="link in linksToNotes()" :link="link"/>
                </div>
                <div v-if="!isEmpty(linksToLinks())" class="note-row">
                    <hr><br>
                    <span class="note-mark">{{ __('Links') }}</span>
                    <hr>
                    <Link v-for="link in linksToLinks()" :link="link"/>
                </div>
            </div>
        </div>
    </div>
</template>
