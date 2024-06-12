<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Textarea } from '@/Components/ui/textarea'
import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'

const props = defineProps({
    comment: Object
})

const form = useForm({
    description: props.comment.description
})

const submit = () => {
    form.post(route('comment.update', props.comment), { _method: 'put' });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 w-full flex justify-center items-center">
            <form action="" class="flex flex-col justify-center gap-4 w-1/3" @submit.prevent="submit">
                <div>
                    <p>Comment</p>                    
                    <Textarea type="text" name="description" id="" v-model="form.description" class="rounded bg-white"></Textarea>
                </div>
                <Link @click="submit" as="button" type="button"><Button class="w-full">Update</Button></Link>
            </form>
        </div>
    </AuthenticatedLayout>
</template>