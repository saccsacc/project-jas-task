<template>
    <AppLayout title="Create task">
      <template #header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Create task</h2>
      </template>

      <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form
              @submit.prevent="submit"
              class="px-8 pt-6 pb-8 m-auto mb-4 bg-white rounded shadow-md"
              enctype="multipart/form-data"
            >
            <div class="grid gap-6 mb-2 md:grid-cols-2">
                <div class="mb-2">
                    <label class="block text-sm font-bold text-gray-700" for="title">
                    Title <span class="text-red-500">*</span>
                    </label>
                    <input
                    v-model="form.title"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="title"
                    type="text"
                    />
                    <span class="text-red-500">{{ errors.title }}</span>
                </div>
                <div class="mb-2">
                    <label class="block text-sm font-bold text-gray-700" for="status">
                    Status <span class="text-red-500">*</span>
                    </label>
                    <div class="xl:w-96">
                    <select
                        v-model="form.status"
                        class="block m-0 text-base font-normal text-gray-700 ease-in-out bg-white bg-no-repeat border border-gray-300 border-solid rounded appearance-none form-select bg-clip-padding focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        aria-label="Status"
                    >
                        <option value="" disabled>Option</option>
                        <option value="pending">pending</option>
                        <option value="in-progress">in-progress</option>
                        <option value="compplete">compplete</option>
                    </select>
                    </div>
                    <span class="text-red-500">{{ errors.status }}</span>
                </div>
            </div>

              <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700" for="name">
                  Description <span class="text-red-500">*</span>
                </label>
                <textarea
                  v-model="form.description"
                  class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                  id="description"
                  type="text"
                />
                <span class="text-red-500">{{ errors.description }}</span>
              </div>

            <div class="grid gap-6 mb-2 md:grid-cols-2">

              <div class="mb-2">
                <label class="block text-sm font-bold text-gray-700" for="due_date">
                  Due Date
                </label>
                <input
                  v-model="form.due_date"
                  class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none mb- 2shadow focus:outline-none focus:shadow-outline"
                  id="due_date"
                  type="date"
                />
                <span class="text-red-500">{{ errors.due_date }}</span>
              </div>

                <div class="mb-2">
                    <label class="block text-sm font-bold text-gray-700" for="user_id">
                    PIC <span class="text-red-500">*</span>
                    </label>
                    <div class="xl:w-96">
                    <select
                        v-model="form.user_id"
                        class="block m-0 text-base font-normal text-gray-700 ease-in-out bg-white bg-no-repeat border border-gray-300 border-solid rounded appearance-none form-select bg-clip-padding focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        aria-label="PIC"
                    >
                        <option value="" disabled>Option</option>
                        <option v-for = "user in users" :value="user.id" >{{user.name}}</option>
                    </select>
                    </div>
                    <span class="text-red-500">{{ errors.user_id }}</span>
                </div>
            </div>

              <div class="flex items-center justify-between">
                <Button :form="form"></Button>
              </div>
            </form>

        </div>
      </div>
    </AppLayout>
  </template>

  <script>
  import Button from "@/Components/Button.vue";
  import AppLayout from "@/Layouts/AppLayout.vue";

  export default {
    components: {
      AppLayout,
      Button,
    },
    props: {
      errors: Object,
      users: Object,
    },
    data() {
      return {
        form: this.$inertia.form({
          title: "",
          description: "",
          status: "",
          due_date: "",
          user_id: "",
        }),
      };
    },
    methods: {
      submit() {
        this.form.post(this.route("tasks.store"), {
          _token: this.$page.props.csrf_token,
        });
      },
    },
  };
  </script>
