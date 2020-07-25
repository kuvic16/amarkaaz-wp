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

    wrapper.vm.generateDaysOfMonth("June");
    expect(wrapper.vm.days.length).toBe(30);
  });

  it("Generate possible start and end time", function() {
    let hour = 11;
    let minute = 13;
    let amPm = "am";
    wrapper.vm.getPossibleCurrentTime(hour, minute, amPm);
    expect(wrapper.vm.repeat_kaaz.start_time).toBe("11:15am");
    expect(wrapper.vm.repeat_kaaz.end_time).toBe("11:30am");
  });
});
