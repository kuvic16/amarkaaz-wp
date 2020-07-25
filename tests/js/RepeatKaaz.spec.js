import { mount } from "vue-test-utils";
import expect from "expect";
import RepeatKaaz from "../../resources/js/pages/RepeatKaaz.vue";
import moment from "moment";

describe("RepeatKaaz", () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(RepeatKaaz);
  });

  it("Generate day list of a month", function() {
    wrapper.vm.generateDaysOfMonth("January");
    expect(wrapper.vm.days.length).toBe(31);
  });
});
