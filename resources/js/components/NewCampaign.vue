<template>
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-white">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img alt="Workflow" class="mx-auto h-12 w-auto"
                 src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"/>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                {{ ' ' }}
                <a class="font-medium text-indigo-600 hover:text-indigo-500" href="#">
                    start your 14-day free trial
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form>
                    <template>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="name">Name</label>
                            <input class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" id="name" name="name"
                                   placeholder="Jane Doe"
                                   type="text"/>
                        </div>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="daily_budget">Daily
                                Budget($USD)</label>
                            <input class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" id="daily_budget" name="daily_budget"
                                   placeholder="900"
                                   type="number"/>
                        </div>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="total_budget">Total
                                Budget($USD)</label>
                            <input class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" id="total_budget" name="total_budget"
                                   placeholder="9000"
                                   type="number"/>
                        </div>
                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="start_date">Start Date</label>
                            <input class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" id="start_date" name="start_date"
                                   placeholder=""
                                   type="date"/>
                        </div>

                        <div
                            class="mb-8 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                            <label class="block text-xs font-medium text-gray-900" for="end_date">End Date</label>
                            <input class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" id="end_date" name="end_date"
                                   placeholder=""
                                   type="date"/>
                        </div>
                    </template>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewCampaign"
    }
</script>

<style scoped>

</style>
