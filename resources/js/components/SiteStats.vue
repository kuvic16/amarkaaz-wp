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
  mounted() {
    console.log(this.nonce);
  },
  data() {
    return {
      series: 0,
      lessons: 0,
    };
  },
  created() {
    axios
      .get(this.wp_url + "?action=amar_kaaz_dashboard")
      .then((response) => response.data)
      .then((data) => {
        console.log(data);
        //this.series = data.series;
        //this.lessons = data.lessons;
      });
  },
};
</script>
