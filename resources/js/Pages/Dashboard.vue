<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import { Head } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref, onMounted, watch } from 'vue'
import { Inertia } from "@inertiajs/inertia";
import axios from 'axios';


const props = defineProps({
    clients:{
        type:Object,
        default: () => ({}),
    },

    page_count:Number,

    filters: {
        type: Object,
        default: () => ({}),
    },
})

let page = ref(1);
let clients = ref(null);
let page_count = ref(null);


// onMounted(async () => {
//     await getClients();
// });

const getClients = async () => {
   
    Inertia.get(
        "/dashboard",
        { page: page.value });
        
};

let search = ref(props.filters.search);
watch(search, (value) => {
  Inertia.get(
    "/dashboard",
    { search: value },
    {
      preserveState: true,
    }
  );
});


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="p-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                Vous êtes connecter
            </div>
        </div>
    </AuthenticatedLayout>
</template>
