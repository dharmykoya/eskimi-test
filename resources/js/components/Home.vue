<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Campaigns</h2>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="campaign in campaigns" :key="campaign.id" class="group relative">
                    <div
                        class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <img :alt="campaign" :src="campaign.imageSrc"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Home.vue",
    data() {
        return {
            campaigns: [],
            products: [
                {
                    id: 1,
                    name: 'Basic Tee',
                    href: '#',
                    imageSrc: 'https://printfactory.com.ng/wp-content/uploads/2018/12/pop-up-banner-printfactory-exhibition-events-lagos-ng.png',
                    imageAlt: "Front of men's Basic Tee in black.",
                    price: '$35',
                    color: 'Black',
                },
                {
                    id: 2,
                    name: 'Nomad Tumbler',
                    href: '#',
                    price: '$35',
                    imageSrc: 'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg',
                    imageAlt: 'Olive drab green insulated bottle with flared screw lid and flat top.',
                },
                {
                    id: 3,
                    name: 'Focus Paper Refill',
                    href: '#',
                    price: '$89',
                    imageSrc: 'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg',
                    imageAlt: 'Person using a pen to cross a task off a productivity paper card.',
                },
                {
                    id: 4,
                    name: 'Machined Mechanical Pencil',
                    href: '#',
                    price: '$35',
                    imageSrc: 'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg',
                    imageAlt: 'Hand holding black machined steel mechanical pencil with brass tip and top.',
                },
            ],
        }
    },
    methods: {
        async fetchCampaigns() {
            const response = await fetch('http://localhost:8084/api/campaigns')
            const data = await response.json()
            console.log(78, data)
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
