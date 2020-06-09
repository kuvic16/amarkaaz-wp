<template>
    <div>
        <h1 class="font-normal text-3xl text-gray-700 leading-none mb-8">
            Achievements
        </h1>
        <input
            type="text"
            placeholder="Your api token"
            v-model="token"
            class="border p-2 rounded w-full mb-8"
            @keyup.enter="fetchAchievements"
        />
        <p
            class="text-red-500 italic text-sm"
            v-if="message"
            v-text="message"
        ></p>
        <ul>
            <li
                v-for="achievement in achievements"
                v-text="achievement.name"
            ></li>
        </ul>
    </div>
</template>
<script>
export default {
    mounted() {},
    data() {
        return {
            achievements: [],
            token: "",
            message: ""
        };
    },
    methods: {
        fetchAchievements() {
            axios
                .get(
                    `http://localhost:8000/api/achievements?api_token=${this.token}`
                )
                .catch(error => {
                    this.message = error.response.data.message;
                    this.achievements = [];
                })
                .then(response => {
                    this.achievements = response.data;
                    this.message = "";
                });
        }
    }
};
</script>
