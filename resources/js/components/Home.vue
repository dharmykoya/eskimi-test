<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="flex  justify-between">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Campaigns</h2>
                <!--                <router-link to="/" class="bg-blue-700 px-4  text-white py-1 rounded-md mb-8">Create campaign</router-link>-->
                <router-link
                    :to="{ name: 'new-campaign'}"
                    class="bg-blue-700 px-4  text-white py-1 rounded-md mb-8"
                >
                    Create campaign
                </router-link>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="campaign in campaigns" :key="campaign.id" class="group relative drop-shadow-md">
                    <!--                    <router-link :to="`/campaigns/${campaign.id}`">-->
                    <div class="cursor-pointer" @click.prevent="selectCampaign(campaign)">
                        <div
                            class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img :alt="campaign" :src="`http://127.0.0.1:8084/${campaign.images[0].url}`"
                                 class="w-full h-full object-center object-cover lg:w-full lg:h-full"/>
                        </div>
                        <div class="mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a :href="campaign.href">
                                        <span aria-hidden="true" class="absolute inset-0"/>
                                        {{ campaign.name }}
                                    </a>
                                </h3>
                                <div class="flex justify-between">
                                    <p class="mt-1 text-sm text-gray-500">Daily Budget</p>
                                    <p class="mt-1 text-sm text-gray-500">{{ campaign.daily_budget }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="mt-1 text-sm text-gray-500">Total Budget</p>
                                    <p class="mt-1 text-sm text-gray-500">{{ campaign.total_budget }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="mt-1 text-sm text-gray-500">Start Date</p>
                                    <p class="mt-1 text-sm text-gray-500">{{ campaign.start_date }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="mt-1 text-sm text-gray-500">End Date </p>
                                    <p class="mt-1 text-sm text-gray-500">{{ campaign.end_date }}</p>
                                </div>
                            </div>
                        </div>
                        <!--                    </router-link>-->
                    </div>
                </div>
            </div>
            <modal :showing="showModal" @close="showModal = false">
                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                    <template v-if="images">
                        <div class="mt-10 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                            <div v-for="image in selectedCampaign.images" :key="image.id"
                                 class="group relative drop-shadow-md">
                                <div
                                    class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                    <img :alt="selectedCampaign.name" :src="`http://127.0.0.1:8084/${image.url}`"
                                         class="w-full h-full object-center object-cover lg:w-full lg:h-full max-h-56 max-w-56"/>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <router-link :to="{name: 'edit-campaign', params:  {campaignId: selectedCampaign.id}}"
                                         class="bg-blue-700 rounded-md px-4 py-1 text-white mr-4">Edit
                            </router-link>
                            <router-link :to="{ name: 'campaign', params:  {campaignId: selectedCampaign.id}}"
                                         class="bg-green-600 rounded-md px-4 py-1 text-white">View
                            </router-link>
                        </div>
                    </template>
                </div>
            </modal>
        </div>
    </div>
</template>

<script>

export default {
    name: "Home.vue",
    data() {
        return {
            campaigns: [],
            showModal: false,
            selectedCampaign: null,
        }
    },
    computed: {
        images() {
            return this.selectedCampaign?.images?.length > 0
        }
    },
    methods: {
        closeModal() {
            this.showModal = false;
        },
        openModal() {
            this.showModal = true
        },
        selectCampaign(campaign) {
            this.selectedCampaign = campaign
            this.openModal();
        },
        async fetchCampaigns() {
            const response = await fetch('http://localhost:8084/api/campaigns')
            const data = await response.json()
            return data.data
        }
    },
    async created() {
        this.campaigns = await this.fetchCampaigns();
    }
}

</script>

<style scoped>

</style>
