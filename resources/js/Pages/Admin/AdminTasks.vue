<script setup>
import MagnifyingGlass from '@/Components/Icons/MagnifyingGlass.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import Pagination from '@/Components/Pagination.vue'
import { usePage, Head, router, Link } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue'

const props = defineProps(['tasks']);

const fields = computed(() => {
  return [
    { key: 'company_name', label: 'Company Name' },
    { key: 'company_vat', label: 'VAT' },
    { key: 'company_address', label: 'Address' },
    { key: 'actions', label: 'Actions' }
  ]
});

const rows = computed(() => {
  return props.clients.data.map(({ id, company_name, company_vat, company_address }) => ({ id, company_name, company_vat, company_address }));
});

function confirmDelete(e) {
  if (!window.confirm(" Are you sure？")) {
    e.preventDefault();
  }
}

let search = ref(usePage().props.search);
let pageNumber = ref(1);

let clientsUrl = computed(() => {
  let url = new URL(route("clients.index"));
  url.searchParams.append("page", pageNumber.value);
  if (search.value) {
    url.searchParams.append("search", search.value);
  }

  return url;
});

watch(() => clientsUrl.value,
  (updatedClientsUrl) => {
    router.visit(updatedClientsUrl, {
      preserveScroll: true,
      preserveState: true,
      replace: true,
    });
  }
);

</script>

<template>

  <Head title="Clients" />

  <AuthenticatedLayout>
    <!-- <pre>{{ JSON.stringify($page.props.users, null, 2) }}</pre> -->
    <!-- <pre>{{ JSON.stringify($page.props.auth.can, null, 2) }}</pre> -->

    <div class="overflow-x-auto">
      <div class="flex justify-start align-middle">

        <Link :href="route('clients.create')"
          class="ml-6 rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Add new client
        </Link>

        <div class="ml-14 flex justify-center align-middle w-40">
          {{ search }}
          <div class="block">
            <MagnifyingGlass />
          </div>
          <input v-model="search" type="text" autocomplete="off" placeholder="Search clients data..." id="search" class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset
                            ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                            sm:text-sm sm:leading-6" />
        </div>
      </div>

      <DataTable class="mt-4" :rows="rows" :fields="fields">
        <template #header="{ label }">
          <span v-text="label" />
        </template>
        <template #cell(actions)="{ item }">
          <!-- <code v-text="JSON.stringify(item, null, 2)" :style="{
            whiteSpace: 'pre-wrap',
            textAlign: 'left',
            display: 'block',
            paddingLeft: '3rem'
          }" /> -->
          <div class="flex items-center px-0 py-3">
            <Link as="button" :href="route('clients.edit', item.id)" method="get"
              class="mr-2 flex items-center justify-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Edit
            </Link>
            <Link v-if="$page.props.auth.can['delete clients']" as="button" :href="route('clients.destroy', item.id)"
              method="delete" @click="(e) => confirmDelete(e)"
              class="flex items-center justify-center rounded-lg bg-red-700 px-4 py-2 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Delete
            </Link>
          </div>
        </template>
      </DataTable>
      <pagination :links="clients.links" />
    </div>
  </AuthenticatedLayout>
</template>