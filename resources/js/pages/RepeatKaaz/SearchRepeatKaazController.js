import moment from "moment";

export default {
  mounted() {},
  created() {
    this.getList();
  },
  data: function() {
    return {
      repeat_kaaz_list: [],
    };
  },
  methods: {
    /**
     * Get the list of repeat kaaz
     */
    getList() {
      axios
        .get(this.wp_url + "?action=amar_kaaz_repeatkaaz")
        .then((response) => response.data)
        .then((data) => {
          console.log(data);
          this.repeat_kaaz_list = data.data.repeat_kaaz_list;
        });
    },
  },
};