<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import { guide } from "@/guide";
let resetDeletion = function() {
    guide.deleteAsk = null;
}
let getDeleteAskEntity = function() {
    let entity = guide.deleteAsk.entity ? guide.deleteAsk.entity : guide.deleteAsk.item.entity;
    return entity.charAt(0).toUpperCase() + entity.slice(1);
}
</script>
<style>

</style>
<template>
    <Modal :show="guide.deleteAsk" @close="resetDeletion">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{__('Are you sure your want to delete this data?')}}
            </h2>
            <div class="mt-2 font-bold">
                <div class="uppercase">
                    {{ __(getDeleteAskEntity()) }}
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="resetDeletion">
                    {{__('Cancel')}}
                </SecondaryButton>
                <DangerButton class="ml-3" @click="guide.delete()">
                    {{__('Delete')}}
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>
