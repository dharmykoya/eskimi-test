<template>
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-white">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img alt="Workflow" class="mx-auto h-12 w-auto"
                 src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"/>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create an advert
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                <router-link to="/" class="font-medium text-indigo-600 hover:text-blue-500">Go back Home</router-link>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <p class="text-green-500 mb-4 text-center">{{ successMessage }}</p>
                <div v-if="isError" class="mb-8 mt-4">
                    <p class="text-red-500">Please check the form for errors</p>
                    <ul>
                        <li v-for="(error, index) in formErrors" :key="index" class="text-red-500">
                            {{ error[0] }}
                        </li>
                    </ul>

                </div>
                <form enctype="multipart/form-data" @submit="onSubmit">
                    <template>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="name">Name</label>
                            <input
                                id="name"
                                v-model="nameInput"
                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                name="name"
                                placeholder="Campaign Royal"
                                type="text"/>
                        </div>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="daily_budget">Daily
                                Budget($USD)</label>
                            <input
                                id="daily_budget"
                                v-model="dailyBudgetInput"
                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                name="daily_budget"
                                placeholder="900"
                                type="number"/>
                        </div>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="total_budget">Total
                                Budget($USD)</label>
                            <input
                                id="total_budget"
                                v-model="totalBudgetInput"
                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                name="total_budget"
                                placeholder="9000"
                                type="number"/>
                        </div>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="start_date">Start Date</label>
                            <input
                                id="start_date"
                                v-model="startDateInput"
                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                name="start_date"
                                placeholder=""
                                type="date"/>
                        </div>

                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="end_date">End Date</label>
                            <input
                                id="end_date"
                                v-model="endDateInput"
                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                name="end_date"
                                placeholder=""
                                type="date"/>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 mb-2" for="banners">
                                Banners(multiple)
                            </label>
                            <input id="banners" accept="image/*" class="mb-3" multiple name="banners[]" type="file"
                                   @change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length"
                            >
                            <p class="text-xs text-gray-500">
                                PNG, JPG, GIF up to 2MB
                            </p>
                        </div>

                        <div>
                            <button :disabled="loading" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    type="submit">
                                <span v-if="loading">Submitting...</span>
                                <span v-else>Submit</span>
                            </button>
                        </div>
                    </template>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NewCampaign",
    data() {
        return {
            nameInput: '',
            dailyBudgetInput: '',
            totalBudgetInput: '',
            startDateInput: '',
            endDateInput: '',
            uploadedFiles: [],
            isError: false,
            loading: false,
            formData: null,
            formErrors: [],
            successMessage: ''
        }
    },
    methods: {
        reset() {
            this.formErrors = [];
            this.formData = [];
            this.nameInput = '';
            this.dailyBudgetInput = '';
            this.totalBudgetInput = '';
            this.startDateInput = '';
            this.endDateInput = '';
            this.uploadedFiles = []
        },
        filesChange(inputName, fileList) {
            const formData = new FormData();
            if (!fileList.length) return;
            Array
                .from(Array(fileList.length).keys())
                .map(x => {
                    formData.append(inputName, fileList[x], fileList[x].name);
                });
            this.formData = formData;
        },
        async onSubmit(e) {
            this.isError = false;
            this.loading = true
            e.preventDefault()
            if (!this.nameInput || !this.dailyBudgetInput || !this.totalBudgetInput || !this.startDateInput || !this.endDateInput) {
                this.isError = true;
                this.loading = false
                return
            }
            this.formData?.append('name', this.nameInput)
            this.formData?.append('daily_budget', this.dailyBudgetInput)
            this.formData?.append('total_budget', this.totalBudgetInput)
            this.formData?.append('start_date', this.startDateInput)
            this.formData?.append('end_date', this.endDateInput)

            const res = await fetch('http://localhost:8084/api/campaigns', {
                method: 'POST',
                body: this.formData,
            })
            const data = await res.json()
            this.loading = false
            if (!data.success) {
                this.isError = true;
                if (data.errors) {
                    this.formErrors = Object.entries(data.errors)
                        .map(([, fieldErrors]) =>
                            fieldErrors.map(fieldError => `${fieldError}`)
                        )
                }
                return
            }
            this.reset();
            this.successMessage = "Advert Added";
            this.loading = false
        },
    },
    mounted() {
        this.reset();
    },
}
</script>

<style scoped>

</style>
