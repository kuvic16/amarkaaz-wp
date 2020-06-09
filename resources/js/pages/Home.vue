<template>
    <div>
        <h1 class="font-normal text-3xl text-gray-700 leading-none mb-8">
            Full Logo
        </h1>
        <div class="mb-10">
            <picture
                style="height: 382px"
                class="block shadow flex items-center justify-center mb-6 rounded-lg"
            >
                <img src="/images/logo.svg" alt="logo" />
            </picture>
            <div class="flex justify-between items-center">
                <p>
                    Orginal Logo on
                    <strong>white</strong> background
                </p>
                <a
                    href="/imges/logo.svg"
                    class="border border-gray px-8 py-2 rounded-full text-black font-bold text-xs"
                    >logo.svg</a
                >
            </div>
        </div>
        <div>
            <picture
                style="height: 382px"
                class="block shadow flex items-center justify-center mb-6 bg-blue-700 rounded-lg"
            >
                <img src="/images/negative-logo.svg" alt="logo" />
            </picture>
            <div class="flex justify-between items-center">
                <p>
                    Negative Logo with accent on
                    <strong>dark</strong> background
                </p>
                <a
                    href="/imges/negative-logo.svg"
                    class="border border-gray px-8 py-2 rounded-full text-black font-bold text-xs"
                    >negative-logo.svg</a
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted");
    }
};
</script>
