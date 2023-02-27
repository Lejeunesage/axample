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
        "/client/index",
        { page: page.value });

        
};

let search = ref(props.filters.search);
watch(search, (value) => {
  Inertia.get(
    "/client/index",
    { search: value },
    {
      preserveState: true,
    }
  );
});


</script>

<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des clients</h2>
        </template>
        <div class="shadow max-w-7xl mx-auto sm:px-6 lg:px-8 p-5 my-5">
            <div class="flex justify-end mt-5   max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <form class="flex gap-2">
                    <input 
                        type="text"
                        v-model="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 "  
                        placeholder="Rechercher"
                    >
                  
                </form>
            </div>

            <div class="py-12">
                <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8">
                    
                    <div class="relative shadow overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-indigo-200  ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Prénom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Code
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <tr class="bg-indigo-50 border-b "
                                v-for="client in props.clients.data " 
                                :key="client.id"

                                >
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ client.firstname }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ client.lastname }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.code }}
                                    </td>
                                    <td class="px-6 py-4 flex gap-5">
                                        <SecondaryButton>
                                            Edit
                                        </SecondaryButton>
                                        <DangerButton>
                                            Edit
                                        </DangerButton>

                                    
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="
                flex 
                justify-center
                mb-3
				bg-indigo-50
				shadow
				bg-body
				rounded
				w-75
				ln-max-width
				mx-auto
				p-3 " 
				>
				<v-pagination
                    v-model="page"
                    :pages="props.page_count"
                    :range-size="1"
                    active-color="#337aff"
                    @update:modelValue="getClients"
                />


			</div>
        </div>
    </AuthenticatedLayout>
</template>
