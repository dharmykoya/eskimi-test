<template>
    <div class="bg-white">

        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <router-link to="/" class="bg-blue-700 px-4  text-white py-1 rounded-md mb-8">Back</router-link>
            <div class="flex mt-10">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Name: {{campaignName}}</h2>
                <h2 class="text-2xl font-extrabold tracking-tight text-green-300 mx-8">Daily budget:  {{formatMoney(dailyBudget)}}</h2>
                <h2 class="text-2xl font-extrabold tracking-tight text-green-300">Total budget: {{formatMoney(totalBudget)}}</h2>
            </div>
            <div class="flex mt-4">
                <h2 class="text-xl font-extrabold tracking-tight text-gray-900 mr-8">Start date: {{campaignStartDate}}</h2>
                <h2 class="text-xl font-extrabold tracking-tight text-gray-900">End date: {{campaignEndDate}}</h2>
            </div>

            <template v-if="images">
                <div class="mt-10 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                    <div v-for="image in campaign.images" :key="image.id" class="group relative drop-shadow-md">
                        <div
                            class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img :alt="campaign" :src="`http://127.0.0.1:8084/${image.url}`"
                                 class="w-full h-full object-center object-cover lg:w-full lg:h-full"/>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Campaign",
    data() {
      return {
          campaign: null
      }
    },
    computed: {
        campaignId() {
            return this.$route.params.campaignId;
        },
        campaignName() {
            return this.campaign?.name
        },
        dailyBudget() {
            return this.campaign?.daily_budget
        },
        totalBudget() {
            return this.campaign?.total_budget
        },
        campaignStartDate() {
            return this.campaign?.start_date
        },
        campaignEndDate() {
            return this.campaign?.end_date
        },
        images() {
            return this.campaign?.images?.length > 0
        }
    },
    methods: {
        async fetchCampaign() {
            const response = await fetch(`http://localhost:8084/api/campaigns/${this.campaignId}`)
            const data = await response.json();
            return data.data
        },
        formatMoney(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            }).format(amount);
        },
    },
    async created() {
        this.campaign = await this.fetchCampaign();
    }
}
</script>

<style scoped>

</style>
