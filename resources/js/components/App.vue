<template>
<!--    <div class="min-h-screen w-full flex justify-center items-center">-->
<!--        Hello  I  am Damilola-->
<!--    </div>-->

    <transition>
        <transition name="fade" mode="out-in">
            <router-view />
        </transition>
    </transition>
</template>

<script>
</script>
