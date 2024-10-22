<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue'

const props = defineProps(['image']);

const form = useForm({
    name: null,
    image: null,
});

const submit = () => {
    form.post(route('image.store'));
};

const imagePath = computed(() => {
    if (props.image)
        return "images/" + props.image;
    return null;
}) 
</script>

<template>

    <Head title="Upload Image" />

    <GuestLayout>
        <pre>{{ JSON.stringify($page.props.image, null, 2) }}</pre>
        <pre>{{ JSON.stringify(imagePath, null, 2) }}</pre>
        <img v-if="imagePath" :src="imagePath" width="40%">
        <p v-if="imagePath">image</p>

        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div>
                <InputLabel for="image" value="Image to upload" />

                <input type="text" v-model="form.name" />
                <input type="file" name="image" id="image" class="mt-1 block w-full"
                    @input="form.image = $event.target.files[0]" required autofocus />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>

                <InputError class="mt-2" :message="form.errors.image" />
            </div>
            <div class="mt-4 flex items-center justify-start">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>