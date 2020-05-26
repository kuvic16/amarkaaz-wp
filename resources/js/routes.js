import Logo from "./components/Logo";
import LogoSymbol from "./components/LogoSymbol";
import Colors from "./components/Colors";
import Typography from "./components/Typography";
import Mascot from "./components/Mascot";
import Illustration from "./components/Illustration";
import Wallpapers from "./components/Wallpapers";
import NotFound from "./components/NotFound";
import SiteStats from "./components/SiteStats";
import Achievements from "./components/Achievements";

let LoadersAnimation = () =>
  import(/* webpackChunkName: "loaders" */ "./components/LoadersAnimation");

export default {
  mode: "history",
  linkActiveClass: "font-bold",
  routes: [
    {
      path: "*",
      component: NotFound,
    },
    {
      path: "/",
      component: Logo,
    },
    {
      path: "/logo-symbol",
      component: LogoSymbol,
    },
    {
      path: "/colors",
      component: Colors,
    },
    {
      path: "/typography",
      component: Typography,
    },
    {
      path: "/mascot",
      component: Mascot,
    },
    {
      path: "/illustration",
      component: Illustration,
    },
    {
      path: "/loaders-animation",
      component: LoadersAnimation,
    },
    {
      path: "/wallpapers",
      component: Wallpapers,
    },
    {
      path: "/site-stats",
      component: SiteStats,
    },
    {
      path: "/achievements",
      component: Achievements,
    },
  ],
};
