<template>
    <AppLayout title="Show Task">
        <template #header>
            <Breadcrumb :href="'tasks'" :title="'Tasks'" :property="task" />
        </template>

        <div class="flex flex-col items-center justify-center mt-12 bg-gray-100">
            <div class="w-full max-w-lg overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="p-4">
                <div class="grid gap-6 mb-2 md:grid-cols-2">
                    <div class="my-2">
                        <h2 class="text-sm font-bold text-gray-600 uppercase">Title</h2>
                        <p class="mt-2 text-gray-600">
                            {{ getTask.title }}
                        </p>
                    </div>
                    <div class="my-2">
                        <h2 class="text-sm font-bold text-gray-600 uppercase">Status</h2>
                        <p class="mt-2 text-gray-600">
                            {{ getTask.status }}
                        </p>
                    </div>
                </div>
                <div class="my-2">
                    <h2 class="text-sm font-bold text-gray-600 uppercase">Description</h2>
                    <p class="mt-2 text-gray-600">
                        {{ getTask.description }}
                    </p>
                </div>
                <div class="grid gap-6 mb-2 md:grid-cols-2">
                    <div class="my-2">
                        <h2 class="text-sm font-bold text-gray-600 uppercase">Due Date</h2>
                        <p class="mt-2 text-gray-600">
                            {{ getTask.due_date }}
                        </p>
                    </div>
                    <div class="my-2">
                        <h2 class="text-sm font-bold text-gray-600 uppercase">PIC</h2>
                        <p class="mt-2 text-gray-600">
                            {{ getTask.user.name }}
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </AppLayout>
  </template>

  <script>
  import AppLayout from "@/Layouts/AppLayout.vue";
  import Breadcrumb from "@/Components/Breadcrumb.vue";

  export default {
    components: {
      AppLayout,
      Breadcrumb,
    },
    props: {
      getTask: Object,
    },
    data() {
      return {
        task: {},
      };
    },
    computed: {
    },
  };
  </script>
