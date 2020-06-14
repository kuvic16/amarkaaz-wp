import Home from "./pages/Home";
import TodayKaaz from "./pages/TodayKaaz";
import PreviousKaaz from "./pages/PreviousKaaz";
import UpcomingKaaz from "./pages/UpcomingKaaz";
import RepeatKaaz from "./pages/RepeatKaaz";
import CalenderGraph from "./pages/CalenderGraph";
import Insight from "./pages/Insight";
import KaazCategory from "./pages/KaazCategory";
import Notifications from "./pages/Notifications";
import NotFound from "./pages/NotFound";

// let LoadersAnimation = () =>
//   import(/* webpackChunkName: "loaders" */ "./components/LoadersAnimation");

export default {
  mode: "hash",
  linkActiveClass: "font-bold",
  routes: [
    {
      path: "*",
      component: NotFound,
    },
    {
      path: "/",
      component: Home,
    },
    {
      path: "/today-kaaz",
      component: TodayKaaz,
    },
    {
      path: "/previous-kaaz",
      component: PreviousKaaz,
    },
    {
      path: "/upcoming-kaaz",
      component: UpcomingKaaz,
    },
    {
      path: "/repeat-kaaz",
      component: RepeatKaaz,
    },
    {
      path: "/calender-graph",
      component: CalenderGraph,
    },
    {
      path: "/insight",
      component: Insight,
    },
    {
      path: "/kaaz-category",
      component: KaazCategory,
    },
    {
      path: "/notifications",
      component: Notifications,
    },
  ],
};
