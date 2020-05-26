<template>
    <div>
        <h1 class="font-normal text-3xl text-gray-700 leading-none mb-8">
            Laracast Stats
        </h1>
        <ul>
            <li>
                <strong>Total Series:</strong>
                {{ series }}
            </li>
            <li>
                <strong>Total Lessons:</strong>
                {{ lessons }}
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    mounted() {},
    data() {
        return {
            series: 0,
            lessons: 0
        };
    },
    created() {
        axios
            .get("http://localhost:8090/api/v1/stats")
            .then(response => response.data)
            .then(data => {
                this.series = data.series;
                this.lessons = data.lessons;
            });
    }
};
</script>
