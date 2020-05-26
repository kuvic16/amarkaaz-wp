<template>
    <div>
        <h1 class="font-normal text-3xl text-gray-700 leading-none">
            Loaders And Animations
        </h1>
        <div class="relative flex flext-col items-center p-8">
            <h1 class="text-2xl font-bold mb-8">Conditional Visibility</h1>
            <div class="container w-3/4 bg-gray-200 p-4" style="height: 2000px">
                <a id="new-post-link" href="#" class="text-blue-500"
                    >New Post</a
                >

                <visible when-hidden="#new-post-link">
                    <button
                        class="bg-blue-500 hover:bg-blue-600 rounded-full w-24 h-24 text-white text-4xl fixed z-10 right-0 bottom-0 mr-4 mb-4"
                    >
                        +
                    </button>
                </visible>
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
